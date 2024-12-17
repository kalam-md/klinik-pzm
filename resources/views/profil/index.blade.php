@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card mb-6">
        <div class="card-header">
          <h5 class="mb-0">Ubah Profil</h5>
          <small class="text-danger">
            *Lengkapi profil agar bisa mendaftarkan layanan di klinik!</small>
        </div>
        <div class="card-body">
          <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-floating form-floating-outline mb-6">
              <input type="text" class="form-control" id="basic-default-nama_lengkap" name="nama_lengkap" value="{{ Auth::user()->nama_lengkap }}" />
              <label for="basic-default-nama_lengkap">Nama Lengkap</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="email" class="form-control" id="basic-default-email" name="email" value="{{ Auth::user()->email }}" />
              <label for="basic-default-email">Email</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="number" class="form-control" id="basic-default-nomor_telepon" name="nomor_telepon" value="{{ $biodata->nomor_telepon }}" />
              <label for="basic-default-nomor_telepon">Nomor Telepon</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="date" class="form-control" id="basic-default-tanggal_lahir" name="tanggal_lahir" value="{{ $biodata->tanggal_lahir }}" />
              <label for="basic-default-tanggal_lahir">Tanggal Lahir</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" aria-label="Default select example">
                <option>Pilih jenis kelamin</option>
                <option value="Laki-laki" {{ $biodata->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $biodata->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
              </select>
              <label for="jenis_kelamin">Jenis Kelamin</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <textarea
                id="basic-default-alamat"
                class="form-control"
                style="height: 60px"
                name="alamat">{{ $biodata->alamat }}</textarea>
              <label for="basic-default-alamat">Alamat</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="file" class="form-control" id="basic-default-photo" name="photo" accept="image/*" onchange="previewImage(this)"/>
              <label for="basic-default-photo">Photo</label>
            </div>
            <div class="mb-6">
              <img id="photo-preview" 
                   src="{{ $biodata->photo ? asset('uploads/profil/' . $biodata->photo) : asset('assets/img/avatars/1.png') }}" 
                   alt="Preview Foto" 
                   style="max-width: 200px; max-height: 200px; display: block; margin: 10px 0;">
            </div>
            <button type="submit" class="btn btn-primary me-3">Ubah</button>
            <a href="{{ route('beranda') }}" type="submit" class="btn btn-outline-primary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function previewImage(input) {
      const preview = document.getElementById('photo-preview');
      const file = input.files[0];
      const reader = new FileReader();
  
      reader.onloadend = function () {
          preview.src = reader.result;
      }
  
      if (file) {
          reader.readAsDataURL(file);
      } else {
          preview.src = "{{ $biodata->photo ? asset('uploads/profil/' . $biodata->photo) : asset('default-avatar.png') }}";
      }
  }
  </script>
@endsection