@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <!-- Detail Rekam Medis -->
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Detail Rekam Medis</h5>
          <a href="{{ route('riwayat-medis.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="ri-arrow-left-line me-1"></i>Kembali
          </a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Kode Pendaftaran</label>
              <p class="mb-0">{{ $rekamMedis->pendaftaran->kode_pendaftaran }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Tanggal Pemeriksaan</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($rekamMedis->pendaftaran->tanggal_pendaftaran)->format('d F Y') }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Poli Klinik</label>
              <p class="mb-0"><span class="badge bg-info">{{ $rekamMedis->pendaftaran->jadwaldokter->dokter->poliklinik->nama_poli }}</span></p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Dokter Pemeriksa</label>
              <p class="mb-0">{{ $rekamMedis->pendaftaran->jadwaldokter->dokter->nama_dokter }}</p>
              <small class="text-muted">{{ $rekamMedis->pendaftaran->jadwaldokter->dokter->spesialis }}</small>
            </div>
          </div>
          
          <hr>
          
          <div class="row">
            <div class="col-12 mb-4">
              <label class="form-label fw-semibold">Diagnosis</label>
              <div class="p-3 bg-light rounded">
                @if($rekamMedis->diagnosis)
                  <p class="mb-0">{{ $rekamMedis->diagnosis }}</p>
                @else
                  <p class="mb-0 text-muted fst-italic">Diagnosis tidak tersedia</p>
                @endif
              </div>
            </div>
            
            <div class="col-12 mb-4">
              <label class="form-label fw-semibold">Perawatan & Tindakan</label>
              <div class="p-3 bg-light rounded">
                @if($rekamMedis->perawatan)
                  <p class="mb-0">{{ $rekamMedis->perawatan }}</p>
                @else
                  <p class="mb-0 text-muted fst-italic">Perawatan tidak tersedia</p>
                @endif
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Nomor Antrian</label>
              <p class="mb-0"><span class="badge bg-primary fs-6">{{ $rekamMedis->pendaftaran->nomor_antrian }}</span></p>
            </div>
            
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Status Pemeriksaan</label>
              <p class="mb-0">
                @if($rekamMedis->pendaftaran->status == 'selesai')
                  <span class="badge bg-success">Selesai</span>
                @else
                  <span class="badge bg-warning">{{ ucfirst($rekamMedis->pendaftaran->status) }}</span>
                @endif
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Riwayat Medis Lainnya -->
      @if($riwayatLain->count() > 0)
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Riwayat Medis Lainnya</h5>
          <small class="text-muted">Riwayat pemeriksaan lain dari pasien yang sama</small>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Poli</th>
                  <th>Dokter</th>
                  <th>Diagnosis</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($riwayatLain as $riwayat)
                <tr>
                  <td>{{ \Carbon\Carbon::parse($riwayat->pendaftaran->tanggal_pendaftaran)->format('d/m/Y') }}</td>
                  <td><span class="badge bg-secondary">{{ $riwayat->pendaftaran->jadwaldokter->dokter->poliklinik->nama_poli }}</span></td>
                  <td>{{ $riwayat->pendaftaran->jadwaldokter->dokter->nama_dokter }}</td>
                  <td>{{ Str::limit($riwayat->diagnosis ?: 'Tidak ada diagnosis', 30) }}</td>
                  <td>
                    <a href="{{ route('riwayat-medis.show', $riwayat->slug) }}" class="btn btn-sm btn-outline-primary">
                      <i class="ri-eye-line"></i>
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      @endif
    </div>

    <!-- Informasi Pasien -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Informasi Pasien</h5>
        </div>
        <div class="card-body">
          <!-- Foto Profil -->
          <div class="text-center mb-4">
            @if($rekamMedis->pendaftaran->pasien->biodata && $rekamMedis->pendaftaran->pasien->biodata->photo)
              <img src="{{ asset('storage/' . $rekamMedis->pendaftaran->pasien->biodata->photo) }}" 
                   alt="Foto Pasien" 
                   class="rounded-circle" 
                   width="80" height="80">
            @else
              <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                   style="width: 80px; height: 80px;">
                <i class="ri-user-line text-white ri-32px"></i>
              </div>
            @endif
            <h5 class="mt-2 mb-0">{{ $rekamMedis->pendaftaran->pasien->nama_lengkap }}</h5>
          </div>

          <!-- Detail Biodata -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <p class="mb-0">{{ $rekamMedis->pendaftaran->pasien->email }}</p>
          </div>
          
          @if($rekamMedis->pendaftaran->pasien->biodata)
            @if($rekamMedis->pendaftaran->pasien->biodata->nomor_telepon)
            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor Telepon</label>
              <p class="mb-0">{{ $rekamMedis->pendaftaran->pasien->biodata->nomor_telepon }}</p>
            </div>
            @endif

            @if($rekamMedis->pendaftaran->pasien->biodata->tanggal_lahir)
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Lahir</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($rekamMedis->pendaftaran->pasien->biodata->tanggal_lahir)->format('d F Y') }}</p>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Umur</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($rekamMedis->pendaftaran->pasien->biodata->tanggal_lahir)->age }} tahun</p>
            </div>
            @endif

            @if($rekamMedis->pendaftaran->pasien->biodata->jenis_kelamin)
            <div class="mb-3">
              <label class="form-label fw-semibold">Jenis Kelamin</label>
              <p class="mb-0">{{ ucfirst($rekamMedis->pendaftaran->pasien->biodata->jenis_kelamin) }}</p>
            </div>
            @endif

            @if($rekamMedis->pendaftaran->pasien->biodata->alamat)
            <div class="mb-3">
              <label class="form-label fw-semibold">Alamat</label>
              <p class="mb-0">{{ $rekamMedis->pendaftaran->pasien->biodata->alamat }}</p>
            </div>
            @endif
          @endif

          <!-- Statistik Kunjungan -->
          <hr>
          <div class="text-center">
            <small class="text-muted">Total Kunjungan</small>
            <h4 class="text-primary mb-0">{{ $riwayatLain->count() + 1 }}</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection