@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card overflow-hidden">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Poli Klinik</h5>
          <a href="{{ route('poli-klinik.create') }}" class="btn btn-primary">Tambah Data Poli Klinik</a>
        </div>
        <div class="table-responsive">
          <table class="table table-sm">
            <thead>
              <tr>
                <th class="text-truncate">Nama Poli Klinik</th>
                <th class="text-truncate">Deskripsi</th>
                <th class="text-truncate text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($poliKliniks as $poli)
              <tr>
                <td>
                  <h6 class="mb-0 text-truncate">{{ $poli->nama_poli }}</h6>
                </td>
                <td class="text-truncate">
                  <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $poli->deskripsi ?? 'Tidak ada deskripsi' }}">
                    {{ Str::limit($poli->deskripsi ?? 'Tidak ada deskripsi', 85, '...') }}
                  </span>
                </td>
                <td class="text-truncate text-center">
                  <a href="{{ route('poli-klinik.edit', $poli->slug) }}"><i class="ri-edit-box-line text-info ri-22px me-2"></i></a>
                  <form action="{{ route('poli-klinik.destroy', $poli->slug) }}" method="POST" class="d-inline">
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