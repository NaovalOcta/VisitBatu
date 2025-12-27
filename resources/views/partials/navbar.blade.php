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
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
