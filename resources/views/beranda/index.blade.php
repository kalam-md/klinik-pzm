@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <!-- Welcome Card -->
    <div class="col-12">
      <div class="card">
        <div class="card-body text-nowrap d-flex justify-content-between align-items-center">
          <h5 class="card-title mb-0 flex-wrap text-nowrap">
            Selamat datang {{ Auth::user()->nama_lengkap }}!
            @if(Auth::user()->role === 'admin')
              <span class="badge bg-label-primary ms-2">Administrator</span>
            @else
              <span class="badge bg-label-success ms-2">Pasien</span>
            @endif
          </h5>
          <a href="{{ route('profil') }}" class="btn btn-sm btn-primary">Lihat profil</a>
        </div>
      </div>
    </div>

    @if(Auth::user()->role === 'admin')
      <!-- Admin Statistics Cards -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Total Pasien</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_pasien'] }}</h4>
                </div>
                <small class="mb-0">Terdaftar di sistem</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-primary">
                  <i class="ri-user-3-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Total Dokter</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_dokter'] }}</h4>
                </div>
                <small class="mb-0">Aktif bertugas</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="ri-stethoscope-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Poliklinik</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_poliklinik'] }}</h4>
                </div>
                <small class="mb-0">Unit layanan</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-info">
                  <i class="ri-building-2-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Hari Ini</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_pendaftaran_hari_ini'] }}</h4>
                </div>
                <small class="mb-0">Pendaftaran</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-warning">
                  <i class="ri-calendar-check-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Admin Status Cards -->
      <div class="col-lg-4 col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex flex-column">
                <div class="card-title mb-auto">
                  <h5 class="mb-1 text-nowrap">Status Pendaftaran</h5>
                  <small class="text-success">Bulan ini: {{ $data['pendaftaran_bulan_ini'] }}</small>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <div class="d-flex">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded bg-label-warning">
                      <i class="ri-time-line ri-24px"></i>
                    </span>
                  </div>
                  <div class="d-flex flex-column">
                    <small class="mb-1">Pending</small>
                    <h6 class="mb-0">{{ $data['pendaftaran_pending'] }}</h6>
                  </div>
                </div>
                <div class="d-flex ms-4">
                  <div class="avatar me-2">
                    <span class="avatar-initial rounded bg-label-success">
                      <i class="ri-check-line ri-24px"></i>
                    </span>
                  </div>
                  <div class="d-flex flex-column">
                    <small class="mb-1">Selesai</small>
                    <h6 class="mb-0">{{ $data['pendaftaran_selesai'] }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Rekam Medis</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_rekam_medis'] }}</h4>
                </div>
                <small class="mb-0">Total tersimpan</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-secondary">
                  <i class="ri-file-text-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-12">
        <div class="card h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="content-left">
              <h5 class="card-title mb-1">Quick Actions</h5>
              <small class="mb-0">Akses cepat menu admin</small>
            </div>
            <div class="content-right">
              <div class="dropdown">
                <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                  Menu
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('antrian.index') }}">Kelola Antrian</a></li>
                  <li><a class="dropdown-item" href="{{ route('pasien.index') }}">Data Pasien</a></li>
                  <li><a class="dropdown-item" href="{{ route('laporan.index') }}">Laporan</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Admin Table - Recent Registrations -->
      <div class="col-12">
        <div class="card overflow-hidden">
          <div class="card-header">
            <h5 class="card-title mb-0">Pendaftaran Terbaru</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="text-truncate">Kode</th>
                  <th class="text-truncate">Pasien</th>
                  <th class="text-truncate">Dokter/Poli</th>
                  <th class="text-truncate">Tanggal</th>
                  <th class="text-truncate">Status</th>
                  <th class="text-truncate">Antrian</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data['pendaftaran_terbaru'] as $pendaftaran)
                <tr>
                  <td class="text-truncate"><strong>{{ $pendaftaran->kode_pendaftaran }}</strong></td>
                  <td>
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-sm me-3">
                        @if($pendaftaran->pasien->biodata && $pendaftaran->pasien->biodata->photo)
                          <img src="{{ asset('storage/'.$pendaftaran->pasien->biodata->photo) }}" alt="Avatar" class="rounded-circle" />
                        @else
                          <span class="avatar-initial rounded-circle bg-label-primary">
                            {{ substr($pendaftaran->pasien->nama_lengkap, 0, 1) }}
                          </span>
                        @endif
                      </div>
                      <div>
                        <h6 class="mb-0 text-truncate">{{ $pendaftaran->pasien->nama_lengkap }}</h6>
                        <small class="text-truncate">{{ $pendaftaran->pasien->email }}</small>
                      </div>
                    </div>
                  </td>
                  <td class="text-truncate">
                    <div>
                      <h6 class="mb-0">{{ $pendaftaran->jadwaldokter->dokter->nama_dokter }}</h6>
                      <small class="text-muted">{{ $pendaftaran->jadwaldokter->dokter->poliklinik->nama_poli }}</small>
                    </div>
                  </td>
                  <td class="text-truncate">{{ \Carbon\Carbon::parse($pendaftaran->tanggal_pendaftaran)->format('d/m/Y') }}</td>
                  <td>
                    @if($pendaftaran->status === 'pending')
                      <span class="badge bg-label-warning rounded-pill">Pending</span>
                    @elseif($pendaftaran->status === 'selesai')
                      <span class="badge bg-label-success rounded-pill">Selesai</span>
                    @else
                      <span class="badge bg-label-danger rounded-pill">Gagal</span>
                    @endif
                  </td>
                  <td><span class="badge bg-label-info">{{ $pendaftaran->nomor_antrian }}</span></td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="text-center text-muted">Belum ada pendaftaran</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>

    @else
      <!-- Patient Statistics Cards -->
      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Total Kunjungan</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_pendaftaran'] }}</h4>
                </div>
                <small class="mb-0">Seluruh waktu</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-primary">
                  <i class="ri-calendar-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Menunggu</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['pendaftaran_pending'] }}</h4>
                </div>
                <small class="mb-0">Belum dilayani</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-warning">
                  <i class="ri-time-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Selesai</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['pendaftaran_selesai'] }}</h4>
                </div>
                <small class="mb-0">Sudah dilayani</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-success">
                  <i class="ri-check-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="card h-100">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
              <div class="content-left">
                <span class="text-heading">Rekam Medis</span>
                <div class="d-flex align-items-center my-1">
                  <h4 class="mb-0 me-2">{{ $data['total_rekam_medis'] }}</h4>
                </div>
                <small class="mb-0">Catatan kesehatan</small>
              </div>
              <div class="avatar">
                <span class="avatar-initial rounded bg-label-info">
                  <i class="ri-file-text-line ri-24px"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Patient Quick Actions -->
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-8">
                <h5 class="card-title">Aksi Cepat</h5>
                <p class="card-text">Kelola pendaftaran dan lihat riwayat kesehatan Anda</p>
              </div>
              <div class="col-md-4 text-end">
                <a href="{{ route('pendaftaran-pasien.create') }}" class="btn btn-primary me-2">
                  <i class="ri-add-line me-1"></i>Daftar Berobat
                </a>
                <a href="{{ route('pendaftaran-pasien.index') }}" class="btn btn-outline-primary">
                  <i class="ri-history-line me-1"></i>Riwayat
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if($data['pendaftaran_mendatang']->count() > 0)
      <!-- Upcoming Appointments -->
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Jadwal Mendatang</h5>
            <small class="text-muted">{{ $data['pendaftaran_mendatang']->count() }} appointment</small>
          </div>
          <div class="card-body">
            @foreach($data['pendaftaran_mendatang'] as $jadwal)
            <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom">
              <div class="d-flex align-items-center">
                <div class="avatar me-3">
                  <span class="avatar-initial rounded bg-label-primary">
                    <i class="ri-calendar-check-line"></i>
                  </span>
                </div>
                <div>
                  <h6 class="mb-0">{{ $jadwal->jadwaldokter->dokter->nama_dokter }}</h6>
                  <small class="text-muted">{{ $jadwal->jadwaldokter->dokter->poliklinik->nama_poli }}</small>
                  <br>
                  <small class="text-primary">{{ \Carbon\Carbon::parse($jadwal->tanggal_pendaftaran)->format('d F Y') }}</small>
                </div>
              </div>
              <div class="text-end">
                <div class="badge bg-label-info mb-1">Antrian {{ $jadwal->nomor_antrian }}</div>
                <br>
                <small class="text-muted">{{ $jadwal->kode_pendaftaran }}</small>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif

      <!-- Patient Medical History -->
      <div class="col-12">
        <div class="card overflow-hidden">
          <div class="card-header">
            <h5 class="card-title mb-0">Riwayat Kunjungan Terbaru</h5>
          </div>
          <div class="table-responsive">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th class="text-truncate">Tanggal</th>
                  <th class="text-truncate">Dokter/Poli</th>
                  <th class="text-truncate">Status</th>
                  <th class="text-truncate">Rekam Medis</th>
                  <th class="text-truncate">Antrian</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data['riwayat_pendaftaran'] as $riwayat)
                <tr>
                  <td class="text-truncate">{{ \Carbon\Carbon::parse($riwayat->tanggal_pendaftaran)->format('d/m/Y') }}</td>
                  <td>
                    <div>
                      <h6 class="mb-0">{{ $riwayat->jadwaldokter->dokter->nama_dokter }}</h6>
                      <small class="text-muted">{{ $riwayat->jadwaldokter->dokter->poliklinik->nama_poli }}</small>
                    </div>
                  </td>
                  <td>
                    @if($riwayat->status === 'pending')
                      <span class="badge bg-label-warning rounded-pill">Pending</span>
                    @elseif($riwayat->status === 'selesai')
                      <span class="badge bg-label-success rounded-pill">Selesai</span>
                    @else
                      <span class="badge bg-label-danger rounded-pill">Gagal</span>
                    @endif
                  </td>
                  <td>
                    @if($riwayat->rekammedis)
                      <span class="badge bg-label-success">✓ Ada</span>
                    @else
                      <span class="badge bg-label-secondary">Belum</span>
                    @endif
                  </td>
                  <td><span class="badge bg-label-info">{{ $riwayat->nomor_antrian }}</span></td>
                </tr>
                @empty
                <tr>
                  <td colspan="5" class="text-center text-muted">Belum ada riwayat kunjungan</td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    @endif

  </div>
</div>
@endsection