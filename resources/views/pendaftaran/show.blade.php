@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card">
        <div class="row">
          <div class="col-12">
            <div class="card-header d-flex justify-content-between align-items-center">
              <div>
                <h5 class="mb-1">{{ $pendaftaranPasien->pasien->nama_lengkap }}</h5>
                <p class="mb-1 card-subtitle mt-0">
                  Kode Pendaftaran : {{ $pendaftaranPasien->kode_pendaftaran }}
                </p>
              </div>
              <div class="badge bg-label-info">
                Antrian ke-{{ $pendaftaranPasien->nomor_antrian }}
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex flex-wrap justify-content-between mb-6">
                <div class="d-flex mb-4 align-items-center">
                  <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                    <div class="mb-sm-0 mb-2">
                      <h6 class="mb-0">Tanggal Pendaftaran</h6>
                      <small>{{ $pendaftaranPasien->jadwaldokter->hari }}, {{ $pendaftaranPasien->tanggal_pendaftaran }}</small>
                    </div>
                  </div>
                </div>
                <div class="d-flex mb-4 align-items-center">
                  <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                    <div class="mb-sm-0 mb-2">
                      <h6 class="mb-0">Dokter</h6>
                      <small>{{ $pendaftaranPasien->jadwaldokter->dokter->nama_dokter }} - {{ $pendaftaranPasien->jadwaldokter->dokter->poliklinik->nama_poli }}</small>
                    </div>
                  </div>
                </div>
                <div class="d-flex mb-4 align-items-center">
                  <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                    <div class="mb-sm-0 mb-2">
                      <h6 class="mb-0">Jam Pemeriksaan</h6>
                      <small>{{ $pendaftaranPasien->jadwaldokter->jam_mulai }} - {{ $pendaftaranPasien->jadwaldokter->jam_selesai }}</small>
                    </div>
                  </div>
                </div>
                <div class="d-flex mb-4 align-items-center">
                  <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                    <div class="mb-sm-0 mb-2">
                      <h6 class="mb-0">Status Pemeriksaan</h6>
                      <small>{{ $pendaftaranPasien->status }}</small>
                    </div>
                  </div>
                </div>
                <div class="d-flex mb-4 align-items-center">
                  <div class="flex-grow-1 d-flex align-items-center justify-content-between">
                    <div class="mb-sm-0 mb-2">
                      <h6 class="mb-0">Keterangan</h6>
                      <small>{{ $pendaftaranPasien->keterangan }}</small>
                    </div>
                  </div>
                </div>
              </div>
              <form action="{{ route('rekam-medis.store') }}" method="POST">
                @csrf
                @if ($pendaftaranPasien->status == 'pending')
                <input type="hidden" name="pendaftaran_id" value="{{ $pendaftaranPasien->id }}">
                <div class="form-floating form-floating-outline mb-6">
                  <input type="text" class="form-control" id="basic-default-diagnosis" name="diagnosis"/>
                  <label for="basic-default-diagnosis">Diagnosis</label>
                </div>
                <div class="form-floating form-floating-outline mb-6">
                  <input type="text" class="form-control" id="basic-default-perawatan" name="perawatan"/>
                  <label for="basic-default-perawatan">Perawatan</label>
                </div>
                <button type="submit" class="btn btn-success me-3">
                  <span class="tf-icons ri-save-line me-1_5"></span> Simpan Rekam Medis
                </button>
                <button type="button"
                  onclick="event.preventDefault(); document.getElementById('batalkan-form').submit();" 
                  class="btn btn-danger me-3">
                  <span class="tf-icons ri-close-circle-line me-1_5"></span> Batalkan
                </button>
                @endif
                <a href="#" class="btn btn-primary me-3">
                  <span class="tf-icons ri-printer-line me-1_5"></span> Cetak
                </a>
                <a href="{{ route('pendaftaran-pasien.index') }}" type="submit" class="btn btn-outline-primary">Kembali</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<form id="batalkan-form" action="{{ route('pendaftaran-pasien.batalkan', $pendaftaranPasien->slug) }}" method="POST" style="display: none;">
  @csrf
  @method('PATCH')
</form>
@endsection