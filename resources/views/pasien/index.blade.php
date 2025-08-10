@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Pasien Terdaftar</h5>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Kode Pendaftaran</th>
                <th class="text-truncate">Nama Pasien</th>
                <th class="text-truncate">Poli Klinik</th>
                <th class="text-truncate">Dokter</th>
                <th class="text-truncate">Tanggal Pendaftaran</th>
                <th class="text-truncate">Status</th>
                <th class="text-truncate">No. Antrian</th>
                <th class="text-truncate text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($pasiens as $pasien)
              <tr>
                <td>
                  <h6 class="mb-0 text-truncate">{{ $pasien->kode_pendaftaran }}</h6>
                </td>
                <td class="text-truncate">
                  {{ $pasien->pasien->nama_lengkap }}
                </td>
                <td class="text-truncate">
                  {{ $pasien->jadwaldokter->dokter->poliklinik->nama_poli }}
                </td>
                <td class="text-truncate">
                  {{ $pasien->jadwaldokter->dokter->nama_dokter }}
                </td>
                <td class="text-truncate">
                  {{ \Carbon\Carbon::parse($pasien->tanggal_pendaftaran)->format('d/m/Y') }}
                </td>
                <td class="text-truncate">
                  @if($pasien->status == 'pending')
                    <span class="badge bg-warning">Pending</span>
                  @elseif($pasien->status == 'selesai')
                    <span class="badge bg-success">Selesai</span>
                  @else
                    <span class="badge bg-danger">Gagal</span>
                  @endif
                </td>
                <td class="text-truncate text-center">
                  <span class="badge bg-primary">{{ $pasien->nomor_antrian }}</span>
                </td>
                <td class="text-truncate text-center">
                  <a href="{{ route('pasien.show', $pasien->slug) }}" title="Detail Pasien">
                    <i class="ri-eye-line text-primary ri-22px me-2"></i>
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="8" class="text-center py-4">
                  <div class="d-flex flex-column align-items-center">
                    <i class="ri-user-search-line ri-48px text-muted mb-2"></i>
                    <h6 class="text-muted">Belum ada data pasien terdaftar</h6>
                  </div>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection