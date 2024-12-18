@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Pendaftaran Pasien</h5>
          <a href="{{ route('pendaftaran-pasien.create') }}" class="btn btn-primary">Tambah Data Pendaftaran Pasien</a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Kode Pendaftaran</th>
                <th class="text-truncate">Nama Pasien</th>
                <th class="text-truncate">Jadwal Pemeriksaan</th>
                <th class="text-truncate text-center">Status</th>
                <th class="text-truncate text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($pendaftaranPasien as $pendaftaran)
              <tr>
                <td>
                  <h6 class="mb-0 text-truncate">
                    <a href="{{ route('pendaftaran-pasien.show', $pendaftaran->slug) }}" class="text-uppercase">{{ $pendaftaran->kode_pendaftaran }}</a>
                  </h6>
                </td>
                <td>
                  {{ $pendaftaran->pasien->nama_lengkap }}
                </td>
                <td class="text-truncate">
                  {{ $pendaftaran->tanggal_pendaftaran }} | {{ $pendaftaran->jadwaldokter->jam_mulai }} - {{ $pendaftaran->jadwaldokter->jam_selesai }} WIB
                </td>
                <td class="text-truncate text-center">
                  @if ($pendaftaran->status == 'pending')
                  <span class="badge bg-label-warning rounded-pill">{{ $pendaftaran->status }}</span>
                  @elseif ($pendaftaran->status == 'selesai')
                  <span class="badge bg-label-success rounded-pill">{{ $pendaftaran->status }}</span>
                  @else
                  <span class="badge bg-label-danger rounded-pill">{{ $pendaftaran->status }}</span>
                  @endif
                </td>
                <td class="text-truncate text-center">
                  <a href="{{ route('pendaftaran-pasien.edit', $pendaftaran->slug) }}"><i class="ri-edit-box-line text-info ri-22px me-2"></i></a>
                  <form action="{{ route('pendaftaran-pasien.destroy', $pendaftaran->slug) }}" method="POST" class="d-inline">
                    @csrf
                    @method('delete')
                    <button type="submit" style="all: unset; cursor: pointer"><i class="ri-delete-bin-line text-danger ri-22px me-2"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection