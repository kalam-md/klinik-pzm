@extends('layout.main')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row gy-6">
    <div class="col-12">
      <div class="card mb-6">
        <div class="card-header">
          <h5 class="mb-0">Edit Data Pendaftaran Pasien</h5>
        </div>
        <div class="card-body">
          <form action="{{ route('pendaftaran-pasien.update', $pendaftaranPasien->slug) }}" method="POST">
            @csrf
            @method('put')
            <div class="form-floating form-floating-outline mb-6">
              <input type="date" class="form-control" id="basic-default-tanggal_pendaftaran" name="tanggal_pendaftaran" value="{{ $pendaftaranPasien->tanggal_pendaftaran }}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
              <label for="basic-default-tanggal_pendaftaran">Tanggal Pendaftaran</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="user_id" name="user_id" aria-label="Default select example">
                <option>Pilih pasien</option>
                @foreach($pasien as $pas)
                    <option value="{{ $pas->id }}" {{ $pendaftaranPasien->user_id == $pas->id ? 'selected' : '' }}>
                        {{ $pas->nama_lengkap }}
                @endforeach
              </select>
              <label for="user_id">Nama Pasien</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <select class="form-select" id="jadwaldokter_id" name="jadwaldokter_id" aria-label="Default select example">
                <option>Pilih jadwal dokter</option>
                @foreach($jadwalDokter as $jadwal)
                    <option value="{{ $jadwal->id }}" {{ $pendaftaranPasien->jadwaldokter_id == $jadwal->id ? 'selected' : '' }}>
                        {{ $jadwal->dokter->nama_dokter }} | {{ $jadwal->hari }}, {{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}
                    </option>
                @endforeach
              </select>
              <label for="jadwaldokter_id">Jadwal Dokter</label>
            </div>
            <div class="form-floating form-floating-outline mb-6">
              <textarea
                id="basic-default-keterangan"
                class="form-control"
                style="height: 60px"
                name="keterangan">{{ $pendaftaranPasien->keterangan }}</textarea>
              <label for="basic-default-keterangan">Keterangan</label>
            </div>
            <button type="submit" class="btn btn-primary me-3">Ubah</button>
            <a href="{{ route('pendaftaran-pasien.index') }}" type="submit" class="btn btn-outline-primary">Kembali</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const tanggalPendaftaran = document.getElementById('basic-default-tanggal_pendaftaran');
    const jadwalDokterSelect = document.getElementById('jadwaldokter_id');
    const originalOptions = Array.from(jadwalDokterSelect.options);
    const previouslySelectedId = '{{ $pendaftaranPasien->jadwaldokter_id }}';

    function filterJadwalDokter() {
        // Ambil hari dari tanggal yang dipilih
        const selectedDate = new Date(tanggalPendaftaran.value);
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const selectedDay = days[selectedDate.getDay()];

        // Reset select option
        jadwalDokterSelect.innerHTML = '<option>Pilih jadwal dokter</option>';

        // Filter dan tambahkan hanya jadwal dokter yang sesuai dengan hari yang dipilih
        originalOptions.forEach(function(option) {
            if (option.textContent.includes(selectedDay)) {
                jadwalDokterSelect.appendChild(option.cloneNode(true));
                
                // Jika opsi adalah jadwal sebelumnya, seleksi kembali
                if (option.value === previouslySelectedId) {
                    option.selected = true;
                }
            }
        });
    }

    // Jalankan filter saat pertama kali halaman dimuat jika sudah ada tanggal
    if (tanggalPendaftaran.value) {
        filterJadwalDokter();
    }

    // Tambahkan event listener untuk perubahan tanggal
    tanggalPendaftaran.addEventListener('change', filterJadwalDokter);
  });
</script>
@endsection