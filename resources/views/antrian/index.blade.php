@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">  
  <!-- Filter Section -->
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Filter Antrian Pasien</h5>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('antrian.index') }}">
        <div class="row g-3">
          <!-- Filter Tanggal Spesifik -->
          <div class="col-md-3">
            <label class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" 
                   value="{{ request('tanggal') }}">
          </div>

          <!-- Filter Bulan -->
          <div class="col-md-2">
            <label class="form-label">Bulan</label>
            <select class="form-select" name="bulan">
              <option value="">Semua Bulan</option>
              @foreach($bulans as $key => $bulan)
                <option value="{{ $key }}" {{ request('bulan') == $key ? 'selected' : '' }}>
                  {{ $bulan }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Filter Tahun -->
          <div class="col-md-2">
            <label class="form-label">Tahun</label>
            <select class="form-select" name="tahun">
              <option value="">Semua Tahun</option>
              @for($year = date('Y'); $year >= 2020; $year--)
                <option value="{{ $year }}" {{ request('tahun') == $year ? 'selected' : '' }}>
                  {{ $year }}
                </option>
              @endfor
            </select>
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
          <div class="col-md-4">
            <label class="form-label">Dokter</label>
            <select class="form-select" name="dokter_id">
              <option value="">Semua Dokter</option>
              @foreach($dokters as $dokter)
                <option value="{{ $dokter->id }}" {{ request('dokter_id') == $dokter->id ? 'selected' : '' }}>
                  {{ $dokter->nama_dokter }} - {{ $dokter->poliklinik->nama_poli }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Filter Hari -->
          <div class="col-md-2">
            <label class="form-label">Hari</label>
            <select class="form-select" name="hari">
              <option value="">Semua Hari</option>
              @foreach($haris as $hari)
                <option value="{{ $hari }}" {{ request('hari') == $hari ? 'selected' : '' }}>
                  {{ $hari }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Filter Status -->
          <div class="col-md-2">
            <label class="form-label">Status</label>
            <select class="form-select" name="status">
              <option value="">Semua Status</option>
              <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
              <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
          </div>

          <!-- Tombol Filter -->
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">
              <i class="ri-search-line me-1"></i>Filter
            </button>
            <a href="{{ route('antrian.index') }}" class="btn btn-outline-secondary">
              <i class="ri-refresh-line me-1"></i>Reset
            </a>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Antrian Table -->
  <div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      <h5 class="mb-0">Antrian Pasien</h5>
      <div class="d-flex align-items-center">
        <span class="badge bg-info me-2">
          Total: {{ $antrians->count() }} pasien
        </span>
        <span class="badge bg-warning me-2">
          Pending: {{ $antrians->where('status', 'pending')->count() }}
        </span>
        <span class="badge bg-success">
          Selesai: {{ $antrians->where('status', 'selesai')->count() }}
        </span>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-sm">
        <thead>
          <tr>
            <th class="text-truncate">No. Antrian</th>
            <th class="text-truncate">Kode Pendaftaran</th>
            <th class="text-truncate">Nama Pasien</th>
            <th class="text-truncate">Poli Klinik</th>
            <th class="text-truncate">Dokter</th>
            <th class="text-truncate">Hari</th>
            <th class="text-truncate">Jam Praktik</th>
            <th class="text-truncate">Tanggal</th>
            <th class="text-truncate">Status</th>
            <th class="text-truncate text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($antrians as $antrian)
          <tr class="{{ $antrian->status == 'selesai' ? 'table-success' : ($antrian->status == 'pending' ? 'table-warning' : '') }}">
            <td>
              <div class="d-flex align-items-center">
                <span class="badge bg-primary fs-6 me-2">{{ $antrian->nomor_antrian }}</span>
              </div>
            </td>
            <td>
              <h6 class="mb-0 text-truncate">{{ $antrian->kode_pendaftaran }}</h6>
            </td>
            <td class="text-truncate">
              <div>
                <strong>{{ $antrian->pasien->nama_lengkap }}</strong>
                @if($antrian->pasien->biodata && $antrian->pasien->biodata->nomor_telepon)
                  <br><small class="text-muted">{{ $antrian->pasien->biodata->nomor_telepon }}</small>
                @endif
              </div>
            </td>
            <td class="text-truncate">
              <span class="badge bg-info">{{ $antrian->jadwaldokter->dokter->poliklinik->nama_poli }}</span>
            </td>
            <td class="text-truncate">
              <strong>{{ $antrian->jadwaldokter->dokter->nama_dokter }}</strong>
              <br><small class="text-muted">{{ $antrian->jadwaldokter->dokter->spesialis }}</small>
            </td>
            <td class="text-truncate">
              <span class="badge bg-secondary">{{ $antrian->jadwaldokter->hari }}</span>
            </td>
            <td class="text-truncate">
              {{ $antrian->jadwaldokter->jam_mulai }} - {{ $antrian->jadwaldokter->jam_selesai }}
            </td>
            <td class="text-truncate">
              {{ \Carbon\Carbon::parse($antrian->tanggal_pendaftaran)->format('d/m/Y') }}
            </td>
            <td class="text-truncate">
              @if($antrian->status == 'pending')
                <span class="badge bg-warning">Menunggu</span>
              @elseif($antrian->status == 'selesai')
                <span class="badge bg-success">Selesai</span>
              @endif
            </td>
            <td class="text-truncate text-center">
              <div class="dropdown">
                <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                  Aksi
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a href="{{ route('pasien.show', $antrian->slug) }}" class="dropdown-item">
                      <i class="ri-eye-line me-2"></i>Detail Pasien
                    </a>
                  </li>
                  @if($antrian->status == 'pending')
                  <li>
                    <button type="button" class="dropdown-item" onclick="updateStatus('{{ $antrian->slug }}', 'selesai')">
                      <i class="ri-check-line me-2"></i>Tandai Selesai
                    </button>
                  </li>
                  @else
                  <li>
                    <button type="button" class="dropdown-item" onclick="updateStatus('{{ $antrian->slug }}', 'pending')">
                      <i class="ri-time-line me-2"></i>Tandai Pending
                    </button>
                  </li>
                  @endif
                </ul>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="10" class="text-center py-4">
              <div class="d-flex flex-column align-items-center">
                <i class="ri-calendar-line ri-48px text-muted mb-2"></i>
                <h6 class="text-muted">Tidak ada antrian pada filter yang dipilih</h6>
                <small class="text-muted">Coba ubah filter atau pilih tanggal lain</small>
              </div>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Script untuk update status -->
<script>
function updateStatus(slug, status) {
    if (confirm('Apakah Anda yakin ingin mengubah status antrian ini?')) {
        fetch(`/antrian/${slug}/update-status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Terjadi kesalahan saat mengupdate status');
            }
        })
        .catch(error => {
            alert('Terjadi kesalahan saat mengupdate status');
        });
    }
}
</script>

@endsection