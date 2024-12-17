@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Dokter</h5>
          <a href="{{ route('dokter.create') }}" class="btn btn-primary">Tambah Data Dokter</a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Nama Dokter</th>
                <th class="text-truncate">Poli</th>
                <th class="text-truncate">Spesialis</th>
                <th class="text-truncate">Nomor Telepon</th>
                <th class="text-truncate">Email</th>
                <th class="text-truncate text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($dokters as $dokter)
              <tr>
                <td>
                  <h6 class="mb-0 text-truncate">{{ $dokter->nama_dokter }}</h6>
                </td>
                <td class="text-truncate">
                  {{ $dokter->poliklinik->nama_poli }}
                </td>
                <td class="text-truncate">
                  {{ $dokter->spesialis }}
                </td>
                <td class="text-truncate">
                  {{ $dokter->nomor_telepon }}
                </td>
                <td class="text-truncate">
                  {{ $dokter->email }}
                </td>
                <td class="text-truncate text-center">
                  <a href="{{ route('dokter.edit', $dokter->slug) }}"><i class="ri-edit-box-line text-info ri-22px me-2"></i></a>
                  <form action="{{ route('dokter.destroy', $dokter->slug) }}" method="POST" class="d-inline">
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