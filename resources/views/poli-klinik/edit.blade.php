@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card mb-6">
        <div class="card-header">
          <h5 class="mb-0">Edit Data Poli Klinik</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('poli-klinik.update', $poliKlinik->slug) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-floating form-floating-outline mb-6">
              <input type="text" class="form-control" id="basic-default-nama_poli" name="nama_poli" value="{{ $poliKlinik->nama_poli }}" />
              <label for="basic-default-nama_poli">Nama Poli Klinik</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <textarea
                id="basic-default-deskripsi"
                class="form-control"
                style="height: 60px"
                name="deskripsi">{{ $poliKlinik->deskripsi }}</textarea>
              <label for="basic-default-deskripsi">Deskripsi</label>
            </div>
            <button type="submit" class="btn btn-primary me-3">Ubah</button>
            <a href="{{ route('poli-klinik.index') }}" type="submit" class="btn btn-outline-primary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection