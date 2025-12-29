<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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
            <div class="col-3">
                <div class="site-logo">
                    <a href="{{ route('welcome_page') }}" class="font-weight-bold">
                        <img src="{{ asset('images/logo.png') }}" alt="Image" class="img-fluid">
                    </a>
                </div>
            </div>

            <div class="col-9 text-right">
                <span class="d-inline-block d-lg-none">
                    <a href="#" class="site-menu-toggle js-menu-toggle py-5 text-white">
                        <span class="icon-menu h3 text-white"></span>
                    </a>
                </span>

                <nav class="site-navigation text-right ml-auto d-none d-lg-block" role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto">
                        <li class="{{ Request::routeIs('welcome_page') ? 'active' : '' }}">
                            <a href="{{ route('welcome_page') }}" class="nav-link">Home</a>
                        </li>
                        <li class="{{ Request::routeIs('about_page') ? 'active' : '' }}">
                            <a href="{{ route('about_page') }}" class="nav-link">About</a>
                        </li>
                        <li class="{{ Request::routeIs('trips_page') ? 'active' : '' }}">
                            <a href="{{ route('trips_page') }}" class="nav-link">Trips</a>
                        </li>
                        <li class="{{ Request::routeIs('blog_page') ? 'active' : '' }}">
                            <a href="{{ route('blog_page') }}" class="nav-link">Blog</a>
                        </li>
                        <li class="{{ Request::routeIs('contact_page') ? 'active' : '' }}">
                            <a href="{{ route('contact_page') }}" class="nav-link">Contact</a>
                        </li>

                        {{-- LOGIKA LOGIN / DASHBOARD / LOGOUT --}}
                        @guest
                            {{-- Jika Belum Login: Tampilkan Tombol Login --}}
                            <li>
                                <a href="{{ route('login') }}" class="btn btn-primary px-3 py-2 text-white">Login</a>
                            </li>
                        @else
                            {{-- Jika Sudah Login: Tampilkan Dropdown User --}}
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle btn btn-outline-white text-white px-3 py-2"
                                    href="#" id="userDropdown" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Halo, {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">

                                    {{-- Cek Role: Admin --}}
                                    @if (Auth::user()->role === 'admin')
                                        <a class="dropdown-item" href="{{ route('admin.dashboard_admin') }}">
                                            <i class="fa-solid fa-gauge mr-3"></i> Dashboard Admin
                                            {{-- <i class="icon-dashboard mr-2"></i> Dashboard Admin --}}
                                        </a>
                                    @else
                                        {{-- Cek Role: User Biasa --}}
                                        <a href="{{ route('posts.create') }}" class="dropdown-item">
                                            <i class="fa-solid fa-pen-to-square mr-3"></i> Create Blog
                                        </a>

                                        <a href="{{ route('user.dashboard_user') }}" class="dropdown-item">
                                            <i class="fa-solid fa-gauge mr-3"></i> User Dashboard
                                            {{-- <i class="icon-dashboard mr-2"></i> User Dashboard --}}
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    {{-- Tombol Logout --}}
                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf {{-- Wajib ada untuk keamanan --}}
                                        <button type="submit" class="dropdown-item text-danger" style="cursor: pointer;">
                                            <i class="fa-solid fa-arrow-right-from-bracket mr-3" style="color: #ff4d4d;"></i> Logout
                                            {{-- <i class="icon-sign-out mr-2"></i> Logout --}}
                                        </button>
                                    </form>
                                </div>
                            </li>
                        @endguest


                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
