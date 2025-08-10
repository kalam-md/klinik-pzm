@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  
  <!-- Filter Section -->
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Filter Riwayat Medis</h5>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('riwayat-medis.index') }}">
        <div class="row g-3">
          <!-- Filter Nama Pasien -->
          <div class="col-md-3">
            <label class="form-label">Nama Pasien</label>
            <input type="text" class="form-control" name="nama_pasien" 
                   value="{{ request('nama_pasien') }}" placeholder="Cari nama pasien...">
          </div>

          <!-- Filter Diagnosis -->
          <div class="col-md-3">
            <label class="form-label">Diagnosis</label>
            <input type="text" class="form-control" name="diagnosis" 
                   value="{{ request('diagnosis') }}" placeholder="Cari diagnosis...">
          </div>

          <!-- Filter Poli Klinik -->
          <div class="col-md-3">
            <label class="form-label">Poli Klinik</label>
            <select class="form-select" name="poli_id">
              <option value="">Semua Poli</option>
              @foreach($polis as $poli)
                <option value="{{ $poli->id }}" {{ request('poli_id') == $poli->id ? 'selected' : '' }}>
                  {{ $poli->nama_poli }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Filter Dokter -->
          <div class="col-md-3">
            <label class="form-label">Dokter</label>
            <select class="form-select" name="dokter_id">
              <option value="">Semua Dokter</option>
              @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}" {{ request('dokter_id') == $dokter->id ? 'selected' : '' }}>
                  {{ $dokter->nama_dokter }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Filter Tanggal Dari -->
          <div class="col-md-3">
            <label class="form-label">Tanggal Dari</label>
            <input type="date" class="form-control" name="tanggal_dari" 
                   value="{{ request('tanggal_dari') }}">
          </div>

          <!-- Filter Tanggal Sampai -->
          <div class="col-md-3">
            <label class="form-label">Tanggal Sampai</label>
            <input type="date" class="form-control" name="tanggal_sampai" 
                   value="{{ request('tanggal_sampai') }}">
          </div>

          <!-- Tombol Filter -->
          <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">
              <i class="ri-search-line me-1"></i>Filter
            </button>
            <a href="{{ route('riwayat-medis.index') }}" class="btn btn-outline-secondary">
              <i class="ri-refresh-line me-1"></i>Reset
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Riwayat Medis Table -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Riwayat Medis Pasien</h5>
      <span class="badge bg-info">Total: {{ $riwayatMedis->total() }} rekam medis</span>
    </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th class="text-truncate">Tanggal</th>
            <th class="text-truncate">Pasien</th>
            <th class="text-truncate">Poli</th>
            <th class="text-truncate">Dokter</th>
            <th class="text-truncate">Diagnosis</th>
            <th class="text-truncate">Perawatan</th>
            <th class="text-truncate text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($riwayatMedis as $rekam)
          <tr>
            <td class="text-truncate">
              <div>
                <strong>{{ \Carbon\Carbon::parse($rekam->pendaftaran->tanggal_pendaftaran)->format('d/m/Y') }}</strong>
                <br><small class="text-muted">{{ $rekam->pendaftaran->kode_pendaftaran }}</small>
              </div>
            </td>
            <td class="text-truncate">
              <div>
                <strong>{{ $rekam->pendaftaran->pasien->nama_lengkap }}</strong>
                @if($rekam->pendaftaran->pasien->biodata)
                  <br><small class="text-muted">
                    @if($rekam->pendaftaran->pasien->biodata->jenis_kelamin)
                      {{ ucfirst($rekam->pendaftaran->pasien->biodata->jenis_kelamin) }}
                    @endif
                    @if($rekam->pendaftaran->pasien->biodata->tanggal_lahir)
                      - {{ \Carbon\Carbon::parse($rekam->pendaftaran->pasien->biodata->tanggal_lahir)->age }} tahun
                    @endif
                  </small>
                @endif
              </div>
            </td>
            <td class="text-truncate">
              <span class="badge bg-info">{{ $rekam->pendaftaran->jadwaldokter->dokter->poliklinik->nama_poli }}</span>
            </td>
            <td class="text-truncate">
              <div>
                <strong>{{ $rekam->pendaftaran->jadwaldokter->dokter->nama_dokter }}</strong>
                <br><small class="text-muted">{{ $rekam->pendaftaran->jadwaldokter->dokter->spesialis }}</small>
              </div>
            </td>
            <td class="text-truncate">
              @if($rekam->diagnosis)
                <span class="badge bg-warning">{{ Str::limit($rekam->diagnosis, 30) }}</span>
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td class="text-truncate">
              @if($rekam->perawatan)
                {{ Str::limit($rekam->perawatan, 40) }}
              @else
                <span class="text-muted">-</span>
              @endif
            </td>
            <td class="text-truncate text-center">
              <a href="{{ route('riwayat-medis.show', $rekam->slug) }}" title="Detail Rekam Medis" class="btn btn-sm btn-outline-primary">
                <i class="ri-eye-line"></i> Detail
              </a>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="7" class="text-center py-4">
              <div class="d-flex flex-column align-items-center">
                <i class="ri-file-text-line ri-48px text-muted mb-2"></i>
                <h6 class="text-muted">Belum ada riwayat medis</h6>
                <small class="text-muted">Riwayat medis akan muncul setelah dokter mengisi rekam medis pasien</small>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    
    <!-- Pagination -->
    @if($riwayatMedis->hasPages())
    <div class="card-footer">
      {{ $riwayatMedis->withQueryString()->links() }}
    </div>
    @endif
  </div>
</div>
@endsection