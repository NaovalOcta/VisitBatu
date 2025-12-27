<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>

<header class="site-navbar site-navbar-target" role="banner">
    <div class="container">
        <div class="row align-items-center position-relative">
            <div class="col-3 ">
                <div class="site-logo">
                    <a href="{{ route('welcome_page') }}" class="font-weight-bold">
                        <img src="{{ asset('images/logo.png') }}" alt="Image" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-9  text-right">
                <span class="d-inline-block d-lg-none">
                    <a href="#" class="site-menu-toggle js-menu-toggle py-5 text-white">
                        <span class="icon-menu h3 text-white"></span>
                    </a>
                </span>

                <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto ">
                        <li class="{{ request()->routeIs('welcome_page') ? 'active' : '' }}">
                            <a href="{{ route('welcome_page') }}" class="nav-link">Home</a>
                        </li>
                        <li class="{{ request()->routeIs('about_page') ? 'active' : '' }}">
                            <a href="{{ route('about_page') }}" class="nav-link">About</a>
                        </li>
                        <li class="{{ request()->routeIs('trips_page') ? 'active' : '' }}">
                            <a href="{{ route('trips_page') }}" class="nav-link">Trips</a>
                        </li>
                        <li class="{{ request()->routeIs('blog_page') ? 'active' : '' }}">
                            <a href="{{ route('blog_page') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="{{ request()->routeIs('contact_page') ? 'active' : '' }}">
                            <a href="{{ route('contact_page') }}" class="nav-link">Contact</a>
                        </li>

                        {{-- LOGIKA AUTHENTICATION --}}
                        @guest
                            {{-- Jika Belum Login: Tampilkan Tombol Login --}}
                            <li class="{{ request()->routeIs('login_page') ? 'active' : '' }}">
                                <a href="{{ route('login_page') }}" class="nav-link">Login</a>
                            </li>
                            <li>
                                <a href="{{ route('register_page') }}"
                                    class="btn btn-primary text-white py-2 px-3 mt-2 mt-lg-0 ml-lg-3"
                                    style="border-radius: 30px;">Sign Up</a>
                            </li>
                        @else
                            {{-- Jika Sudah Login: Tampilkan Nama & Dropdown --}}
                            <li class="has-children">
                                <a href="#" class="nav-link">
                                    {{ Auth::user()->name }}
                                    @if (Auth::user()->role == 'admin')
                                        <span class="badge badge-warning text-white ml-1">Admin</span>
                                    @endif
                                </a>
                                <ul class="dropdown">
                                    {{-- Link ke Dashboard (Otomatis cek role di routes) --}}
                                    <li><a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a></li>

                                    <li>
                                        <hr class="dropdown-divider" style="margin: 0;">
                                    </li>

                                    {{-- Tombol Logout --}}
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="nav-link text-danger">
                                            Logout
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                        {{-- END LOGIKA AUTHENTICATION --}}

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
