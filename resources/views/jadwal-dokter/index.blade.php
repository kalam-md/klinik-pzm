@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Jadwal Dokter</h5>
          <a href="{{ route('jadwal-dokter.create') }}" class="btn btn-primary">Tambah Data Jadwal Dokter</a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Nama Dokter</th>
                <th class="text-truncate">Poli</th>
                <th class="text-truncate">Spesialis</th>
                <th class="text-truncate">Jadwal Dokter</th>
                <th class="text-truncate text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jadwalDokters as $jadwal)
              <tr>
                <td>
                  <h6 class="mb-0 text-truncate">{{ $jadwal->dokter->nama_dokter }}</h6>
                </td>
                <td class="text-truncate">
                  {{ $jadwal->dokter->poliklinik->nama_poli }}
                </td>
                <td class="text-truncate">
                  {{ $jadwal->dokter->spesialis }}
                </td>
                <td class="text-truncate">
                  {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }} WIB
                </td>
                <td class="text-truncate text-center">
                  <a href="{{ route('jadwal-dokter.edit', $jadwal->slug) }}"><i class="ri-edit-box-line text-info ri-22px me-2"></i></a>
                  <form action="{{ route('jadwal-dokter.destroy', $jadwal->slug) }}" method="POST" class="d-inline">
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