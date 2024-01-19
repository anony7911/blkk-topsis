<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="index3.html" class="brand-link">
        {{-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <span class="brand-text font-weight-light">BLKK Kolaka</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('/') }}/name.png" class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::check() ? Auth::user()->name : 'Guest' }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @auth
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    {{-- <a href="#" class="nav-link active"> --}}
                    <a href="{{ url('home') }}" class="nav-link @if(request()->is('home')) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                @endif
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ url('/alternatif') }}" class="nav-link @if(request()->is('alternatif')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Alternatif
                            {{-- <span class="right badge badge-danger">New</span> --}}
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kriteria') }}" class="nav-link @if(request()->is('kriteria')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/perhitungan') }}" class="nav-link @if(request()->is('perhitungan')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Hasil Perhitungan
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/rekomendasi') }}" class="nav-link @if(request()->is('rekomendasi')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Hasil Rekomendasi
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/kelulusan') }}" class="nav-link @if(request()->is('kelulusan')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Kelulusan
                        </p>
                    </a>
                </li>
                @if(auth()->user()->role == 'admin')
                <li class="nav-item">
                    <a href="{{ url('/manajuser') }}" class="nav-link @if(request()->is('manajuser')) active @endif">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Manajemen User
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-header"></li>
                <li class="nav-item text-white">
                    <a href="{{ route('logout') }}" class="nav-link btn btn-md btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p class="text">Keluar</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </nav>
    </div>
</aside>
