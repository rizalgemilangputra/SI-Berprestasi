<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item active">
                    <a href="{{ url('/') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="{{ url('siswa/') }}" class='sidebar-link'>
                        <i class="bi bi-person-plus-fill"></i>
                        <span>Data Siswa</span>
                    </a>
                </li>

                <li class="sidebar-item  ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-person-lines-fill"></i>
                        <span>Siswa Berprestasi</span>
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
