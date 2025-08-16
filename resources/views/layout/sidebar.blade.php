<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="/beranda" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-semibold ms-2">Pratama Zhafira</span>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <!-- Dashboards -->
    <li class="menu-item {{ Request::is('beranda*') ? 'active' : '' }} open">
      <a href="{{ route('beranda') }}" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons ri-home-office-line"></i>
        <div data-i18n="Dashboards">Master Data</div>
      </a>
      <ul class="menu-sub">
        @if (Auth::user()->role == 'admin')
        <li class="menu-item {{ Request::is('pasien*') ? 'active' : '' }}">
          <a href="{{ route('pasien.index') }}" class="menu-link">
            <div>Pasien</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('poli-klinik*') ? 'active' : '' }}">
          <a href="{{ route('poli-klinik.index') }}" class="menu-link">
            <div>Poli Klinik</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('dokter*') ? 'active' : '' }}">
          <a href="{{ route('dokter.index') }}" class="menu-link">
            <div>Dokter</div>
          </a>
        </li>
        <li class="menu-item {{ Request::is('jadwal-dokter*') ? 'active' : '' }}">
          <a href="{{ route('jadwal-dokter.index') }}" class="menu-link">
            <div>Jadwal Dokter</div>
          </a>
        </li>
        @endif
        <li class="menu-item {{ Request::is('antrian*') ? 'active' : '' }}">
          <a href="{{ route('antrian.index') }}" class="menu-link">
            <div>Antrian Pasien</div>
          </a>
        </li>
      </ul>
    </li>

    <li class="menu-item {{ Request::is('pendaftaran-pasien*') ? 'active' : '' }}">
      <a
        href="{{ route('pendaftaran-pasien.index') }}"
        class="menu-link">
        <i class="menu-icon tf-icons ri-sticky-note-add-line"></i>
        <div>Pendaftaran Pasien</div>
      </a>
    </li>
    
    <li class="menu-item {{ Request::is('riwayat-medis*') ? 'active' : '' }}">
      <a href="{{ route('riwayat-medis.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ri-history-line"></i>
        <div>Riwayat Medis Pasien</div>
      </a>
    </li>

    @if (Auth::user()->role == 'admin')
    <li class="menu-item {{ Request::is('laporan*') ? 'active' : '' }}">
      <a href="{{ route('laporan.index') }}" class="menu-link">
        <i class="menu-icon tf-icons ri-file-info-line"></i>
        <div>Laporan</div>
      </a>
    </li>
    @endif
  </ul>
</aside>