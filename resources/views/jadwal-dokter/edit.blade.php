@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card mb-6">
        <div class="card-header">
          <h5 class="mb-0">Edit Data Jadwal Dokter</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('jadwal-dokter.update', $jadwalDokter->slug) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="dokter_id" name="dokter_id" aria-label="Default select example">
                <option>Pilih poli klinik</option>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ $jadwalDokter->dokter_id == $dokter->id ? 'selected' : '' }}>
                      {{ $dokter->nama_dokter }}
                    </option>
                @endforeach
              </select>
              <label for="dokter_id">Poli Klinik</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="hari" name="hari" aria-label="Default select example">
                <option>Pilih hari</option>
                @foreach($hari as $h)
                  <option value="{{ $h }}" 
                      {{ $jadwalDokter->hari == $h ? 'selected' : '' }}>
                      {{ $h }}
                  </option>
                @endforeach
              </select>
              <label for="hari">Hari Praktik</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="time" class="form-control" id="basic-default-jam_mulai" name="jam_mulai" value="{{ $jadwalDokter->jam_mulai }}" />
              <label for="basic-default-jam_mulai">Jam Mulai</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <input type="time" class="form-control" id="basic-default-jam_selesai" name="jam_selesai" value="{{ $jadwalDokter->jam_selesai }}" />
              <label for="basic-default-jam_selesai">Jam Selesai</label>
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