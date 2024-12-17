@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card mb-6">
        <div class="card-header">
          <h5 class="mb-0">Edit Data Dokter</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('dokter.update', $dokter->slug) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-floating form-floating-outline mb-6">
              <input type="text" class="form-control" id="basic-default-nama_dokter" name="nama_dokter" value="{{ $dokter->nama_dokter }}" />
              <label for="basic-default-nama_dokter">Nama Dokter</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="poliklinik_id" name="poliklinik_id" aria-label="Default select example">
                <option>Pilih poli klinik</option>
                @foreach($polikliniks as $poliklinik)
                <option value="{{ $poliklinik->id }}" {{ $dokter->poliklinik_id == $poliklinik->id ? 'selected' : '' }}>
                  {{ $poliklinik->nama_poli }}
                </option>
                @endforeach
              </select>
              <label for="poliklinik_id">Poli Klinik</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="text" class="form-control" id="basic-default-spesialis" name="spesialis" value="{{ $dokter->spesialis }}" />
              <label for="basic-default-spesialis">Spesialis</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="number" class="form-control" id="basic-default-nomor_telepon" name="nomor_telepon" value="{{ $dokter->nomor_telepon }}" />
              <label for="basic-default-nomor_telepon">Nomor Telepon</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="email" class="form-control" id="basic-default-email" name="email" value="{{ $dokter->email }}" />
              <label for="basic-default-email">Email</label>
            </div>
            <button type="submit" class="btn btn-primary me-3">Ubah</button>
            <a href="{{ route('dokter.index') }}" type="submit" class="btn btn-outline-primary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection