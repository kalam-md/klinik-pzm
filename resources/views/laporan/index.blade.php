@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  
  <!-- Filter Periode -->
  <div class="card mb-4">
    <div class="card-header">
      <h5 class="mb-0">Filter Periode Laporan</h5>
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('laporan.index') }}">
        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="tanggal_mulai" value="{{ $tanggalMulai }}">
          </div>
          <div class="col-md-3">
            <label class="form-label">Tanggal Selesai</label>
            <input type="date" class="form-control" name="tanggal_selesai" value="{{ $tanggalSelesai }}">
          </div>
          <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">
              <i class="ri-search-line me-1"></i>Filter
            </button>
            <button type="button" class="btn btn-success" onclick="window.print()">
              <i class="ri-printer-line me-1"></i>Cetak Laporan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Statistik Cards -->
  <div class="row mb-4">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-primary rounded">
                <i class="ri-file-list-line"></i>
              </div>
            </div>
            <div>
              <small>Total Pendaftaran</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['total_pendaftaran']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-success rounded">
                <i class="ri-user-line"></i>
              </div>
            </div>
            <div>
              <small>Total Pasien</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['total_pasien']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-info rounded">
                <i class="ri-user-heart-line"></i>
              </div>
            </div>
            <div>
              <small>Total Dokter</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['total_dokter']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-warning rounded">
                <i class="ri-hospital-line"></i>
              </div>
            </div>
            <div>
              <small>Poli Klinik</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['total_poli_klinik']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-success rounded">
                <i class="ri-check-line"></i>
              </div>
            </div>
            <div>
              <small>Selesai</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['pendaftaran_selesai']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-2 col-md-4 col-sm-6 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-center">
            <div class="avatar flex-shrink-0 me-3">
              <div class="avatar-initial bg-danger rounded">
                <i class="ri-file-text-line"></i>
              </div>
            </div>
            <div>
              <small>Rekam Medis</small>
              <h5 class="mb-0">{{ number_format($statistikUmum['rekam_medis_terisi']) }}</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Charts & Tables Row -->
  <div class="row">
    <!-- Grafik Pendaftaran Harian -->
    <div class="col-lg-8 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Grafik Pendaftaran Harian</h5>
        </div>
        <div class="card-body">
          <canvas id="chartPendaftaranHarian" height="300"></canvas>
        </div>
      </div>
    </div>

    <!-- Distribusi Status -->
    <div class="col-lg-4 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Distribusi Status</h5>
        </div>
        <div class="card-body">
          <canvas id="chartDistribusiStatus" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Tables Row -->
  <div class="row">
    <!-- Top Poli Klinik -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Top 5 Poli Klinik</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Ranking</th>
                <th>Poli Klinik</th>
                <th>Total Pendaftaran</th>
              </tr>
            </thead>
            <tbody>
              @forelse($topPoliKlinik as $key => $poli)
              <tr>
                <td>
                  @if($key == 0)
                    <span class="badge bg-warning">🏆 {{ $key + 1 }}</span>
                  @elseif($key == 1)
                    <span class="badge bg-secondary">🥈 {{ $key + 1 }}</span>
                  @elseif($key == 2)
                    <span class="badge bg-warning">🥉 {{ $key + 1 }}</span>
                  @else
                    <span class="badge bg-light text-dark">{{ $key + 1 }}</span>
                  @endif
                </td>
                <td>{{ $poli->nama_poli }}</td>
                <td><span class="badge bg-primary">{{ $poli->total_pendaftaran }}</span></td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center text-muted">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Top Dokter -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Top 5 Dokter</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Ranking</th>
                <th>Dokter</th>
                <th>Poli</th>
                <th>Total Pasien</th>
              </tr>
            </thead>
            <tbody>
              @forelse($topDokter as $key => $dokter)
              <tr>
                <td>
                  @if($key == 0)
                    <span class="badge bg-warning">🏆 {{ $key + 1 }}</span>
                  @elseif($key == 1)
                    <span class="badge bg-secondary">🥈 {{ $key + 1 }}</span>
                  @elseif($key == 2)
                    <span class="badge bg-warning">🥉 {{ $key + 1 }}</span>
                  @else
                    <span class="badge bg-light text-dark">{{ $key + 1 }}</span>
                  @endif
                </td>
                <td>
                  <strong>{{ $dokter->nama_dokter }}</strong>
                  <br><small class="text-muted">{{ $dokter->spesialis }}</small>
                </td>
                <td><span class="badge bg-info">{{ $dokter->poliklinik->nama_poli }}</span></td>
                <td><span class="badge bg-primary">{{ $dokter->total_pendaftaran }}</span></td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Second Row Tables -->
  <div class="row">
    <!-- Pasien Terbaru -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Pasien Terbaru</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Poli</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pasienTerbaru as $pasien)
              <tr>
                <td>{{ \Carbon\Carbon::parse($pasien->tanggal_pendaftaran)->format('d/m') }}</td>
                <td>
                  <strong>{{ $pasien->pasien->nama_lengkap }}</strong>
                  <br><small class="text-muted">{{ $pasien->kode_pendaftaran }}</small>
                </td>
                <td><span class="badge bg-info">{{ $pasien->jadwaldokter->dokter->poliklinik->nama_poli }}</span></td>
                <td>
                  @if($pasien->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                  @elseif($pasien->status == 'selesai')
                    <span class="badge bg-success">Selesai</span>
                  @else
                    <span class="badge bg-danger">{{ ucfirst($pasien->status) }}</span>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Diagnosis Terbanyak -->
    <div class="col-lg-6 mb-4">
      <div class="card">
        <div class="card-header">
          <h5 class="mb-0">Top 10 Diagnosis</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th>No</th>
                <th>Diagnosis</th>
                <th>Jumlah Kasus</th>
              </tr>
            </thead>
            <tbody>
              @forelse($diagnosisTerbanyak as $key => $diagnosis)
              <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $diagnosis->diagnosis }}</td>
                <td><span class="badge bg-danger">{{ $diagnosis->jumlah }}</span></td>
              </tr>
              @empty
              <tr>
                <td colspan="3" class="text-center text-muted">Tidak ada data diagnosis</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Grafik Pendaftaran Harian
const ctxHarian = document.getElementById('chartPendaftaranHarian').getContext('2d');
const chartHarian = new Chart(ctxHarian, {
    type: 'line',
    data: {
        labels: [
            @foreach($pendaftaranHarian as $data)
                '{{ \Carbon\Carbon::parse($data->tanggal)->format("d/m") }}',
            @endforeach
        ],
        datasets: [{
            label: 'Pendaftaran Harian',
            data: [
                @foreach($pendaftaranHarian as $data)
                    {{ $data->jumlah }},
                @endforeach
            ],
            borderColor: 'rgb(75, 192, 192)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// Chart Distribusi Status
const ctxStatus = document.getElementById('chartDistribusiStatus').getContext('2d');
const chartStatus = new Chart(ctxStatus, {
    type: 'doughnut',
    data: {
        labels: [
            @foreach($distribusiStatus as $status)
                '{{ ucfirst($status->status) }}',
            @endforeach
        ],
        datasets: [{
            data: [
                @foreach($distribusiStatus as $status)
                    {{ $status->jumlah }},
                @endforeach
            ],
            backgroundColor: [
                '#ffab00',
                '#28c76f',
                '#ea5455',
                '#00cfe8'
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});
</script>

@endsection