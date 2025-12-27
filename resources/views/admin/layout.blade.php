<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - VisitBatu</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        :root {
            --admin-primary: #2d3e50;
            --admin-accent: #17a2b8;
        }

        body {
            background-color: #f4f7f6;
            font-family: "Poppins", sans-serif;
        }

        #sidebar {
            min-width: 250px;
            max-width: 250px;
            background: var(--admin-primary);
            min-height: 100vh;
            transition: all 0.3s;
        }

        #sidebar .sidebar-header {
            padding: 20px;
            background: #243140;
            text-align: center;
        }

        #sidebar ul.components {
            padding: 20px 0;
            border-bottom: 1px solid #47748b;
        }

        #sidebar ul li a {
            padding: 12px 25px;
            font-size: 1.1em;
            display: block;
            color: #adb5bd;
            text-decoration: none;
        }

        #sidebar ul li a:hover,
        #sidebar ul li.active>a {
            color: #fff;
            background: var(--admin-accent);
        }

        #sidebar ul li a i {
            margin-right: 10px;
        }

        .content-wrapper {
            width: 100%;
            padding: 30px;
        }

        .navbar-admin {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 15px 30px;
        }
    </style>
</head>

<body>
    <div class="d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3 class="text-white mb-0">Visit<span class="text-info">Batu</span></h3>
                <small class="text-muted">Admin Panel</small>
            </div>
            <ul class="list-unstyled components">
                <li class="{{ Request::is('admin/dashboard_admin') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard_admin') }}"><i class="icon-dashboard"></i> Dashboard</a>
                </li>
                <li class="{{ Request::is('admin/trips*') ? 'active' : '' }}">
                    <a href="{{ route('admin.trips.index') }}"><i class="icon-map"></i> Kelola Wisata</a>
                </li>
                <li class="{{ Request::is('admin/posts*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}"><i class="icon-book"></i> Blog & Artikel</a>
                </li>
                <li>
                    <a href="/"><i class="icon-eye"></i> Lihat Website</a>
                </li>
            </ul>
        </nav>

        <div class="content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-admin rounded-3 shadow-sm mb-4">
                <div class="container-fluid">
                    <span class="navbar-text fw-bold text-dark">Selamat Datang, {{ Auth::user()->name }}</span>
                    <div class="ms-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-danger btn-sm rounded-pill">Logout</button>
                        </form>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
