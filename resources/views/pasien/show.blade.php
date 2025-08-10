@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <!-- Informasi Pendaftaran -->
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Detail Pendaftaran Pasien</h5>
          <a href="{{ route('pasien.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="ri-arrow-left-line me-1"></i>Kembali
          </a>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Kode Pendaftaran</label>
              <p class="mb-0">{{ $pasien->kode_pendaftaran }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Tanggal Pendaftaran</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($pasien->tanggal_pendaftaran)->format('d F Y') }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Status</label>
              <div>
                @if($pasien->status == 'pending')
                  <span class="badge bg-warning">Pending</span>
                @elseif($pasien->status == 'selesai')
                  <span class="badge bg-success">Selesai</span>
                @else
                  <span class="badge bg-danger">Gagal</span>
                @endif
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Nomor Antrian</label>
              <p class="mb-0"><span class="badge bg-primary fs-6">{{ $pasien->nomor_antrian }}</span></p>
            </div>
            @if($pasien->keterangan)
            <div class="col-12 mb-3">
              <label class="form-label fw-semibold">Keterangan</label>
              <p class="mb-0">{{ $pasien->keterangan }}</p>
            </div>
            @endif
          </div>
        </div>
      </div>

      <!-- Informasi Dokter & Jadwal -->
      <div class="card mb-4">
        <div class="card-header">
          <h5 class="mb-0">Informasi Dokter & Jadwal</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Poli Klinik</label>
              <p class="mb-0">{{ $pasien->jadwaldokter->dokter->poliklinik->nama_poli }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Dokter</label>
              <p class="mb-0">{{ $pasien->jadwaldokter->dokter->nama_dokter }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Spesialis</label>
              <p class="mb-0">{{ $pasien->jadwaldokter->dokter->spesialis }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Hari</label>
              <p class="mb-0">{{ $pasien->jadwaldokter->hari }}</p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="form-label fw-semibold">Jam Praktik</label>
              <p class="mb-0">{{ $pasien->jadwaldokter->jam_mulai }} - {{ $pasien->jadwaldokter->jam_selesai }}</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Rekam Medis -->
      @if($pasien->rekammedis)
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Rekam Medis</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12 mb-3">
              <label class="form-label fw-semibold">Diagnosis</label>
              <p class="mb-0">{{ $pasien->rekammedis->diagnosis ?: 'Belum ada diagnosis' }}</p>
            </div>
            <div class="col-12 mb-3">
              <label class="form-label fw-semibold">Perawatan</label>
              <p class="mb-0">{{ $pasien->rekammedis->perawatan ?: 'Belum ada perawatan' }}</p>
            </div>
          </div>
        </div>
      </div>
      @else
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Rekam Medis</h5>
        </div>
        <div class="card-body text-center">
          <i class="ri-file-text-line ri-48px text-muted mb-2"></i>
          <p class="text-muted mb-0">Rekam medis belum tersedia</p>
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
            @if($pasien->pasien->biodata && $pasien->pasien->biodata->photo)
              <img src="{{ asset('storage/' . $pasien->pasien->biodata->photo) }}" 
                   alt="Foto Pasien" 
                   class="rounded-circle" 
                   width="80" height="80">
            @else
              <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mx-auto" 
                   style="width: 80px; height: 80px;">
                <i class="ri-user-line text-white ri-32px"></i>
              </div>
            @endif
            <h5 class="mt-2 mb-0">{{ $pasien->pasien->nama_lengkap }}</h5>
          </div>

          <!-- Detail Biodata -->
          <div class="mb-3">
            <label class="form-label fw-semibold">Email</label>
            <p class="mb-0">{{ $pasien->pasien->email }}</p>
          </div>
          
          @if($pasien->pasien->biodata)
            @if($pasien->pasien->biodata->nomor_telepon)
            <div class="mb-3">
              <label class="form-label fw-semibold">Nomor Telepon</label>
              <p class="mb-0">{{ $pasien->pasien->biodata->nomor_telepon }}</p>
            </div>
            @endif

            @if($pasien->pasien->biodata->tanggal_lahir)
            <div class="mb-3">
              <label class="form-label fw-semibold">Tanggal Lahir</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($pasien->pasien->biodata->tanggal_lahir)->format('d F Y') }}</p>
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Umur</label>
              <p class="mb-0">{{ \Carbon\Carbon::parse($pasien->pasien->biodata->tanggal_lahir)->age }} tahun</p>
            </div>
            @endif

            @if($pasien->pasien->biodata->jenis_kelamin)
            <div class="mb-3">
              <label class="form-label fw-semibold">Jenis Kelamin</label>
              <p class="mb-0">{{ ucfirst($pasien->pasien->biodata->jenis_kelamin) }}</p>
            </div>
            @endif

            @if($pasien->pasien->biodata->alamat)
            <div class="mb-3">
              <label class="form-label fw-semibold">Alamat</label>
              <p class="mb-0">{{ $pasien->pasien->biodata->alamat }}</p>
            </div>
            @endif
          @else
            <div class="text-center text-muted">
              <i class="ri-user-search-line ri-32px mb-2"></i>
              <p class="mb-0">Data biodata belum lengkap</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection