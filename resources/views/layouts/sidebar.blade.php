<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ url('/') }}" style="font-size: 0.7em !important;">Sistem Informasi</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                {{-- <li class="sidebar-item active">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li> --}}

                <li class="sidebar-item {{ (request()->is('user*')) ? 'active' : '' }}">
                    <a href="{{ route('manage.user') }}" class='sidebar-link'>
                        <i class="bi bi-person-fill"></i>
                        <span>Manajemen Pengguna</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('siswa*')) ? 'active' : '' }}">
                    <a href="{{ route('manage.siswa') }}" class='sidebar-link'>
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Menajemen Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('detail_nilai*')) ? 'active' : '' }}">
                    <a href="{{ route('manage.detail_nilai') }}" class='sidebar-link'>
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Tambah Nilai Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('generate_laporan*')) ? 'active' : '' }}">
                    <a href="{{ route('manage.generate_laporan') }}" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Generate Laporan Siswa Berprestasi</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->is('laporan*')) ? 'active' : '' }}">
                    <a href="{{ route('manage.laporan') }}" class='sidebar-link'>
                        <i class="bi bi-award-fill"></i>
                        <span>Laporan Siswa Berprestasi</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class='sidebar-link'>
                        <i class="bi bi-arrow-left-square"></i>
                        <span>Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>

            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
