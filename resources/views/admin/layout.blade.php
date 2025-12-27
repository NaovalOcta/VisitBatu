@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    {{-- Hero Section Kecil untuk Header Admin --}}
    <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay"
            style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 300px; min-height: 300px;">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-7">
                        <h1 class="mb-3 text-white">Admin Dashboard</h1>
                        <p class="text-white">Manage Trips & Blog Moderation</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                {{-- SIDEBAR ADMIN --}}
                <div class="col-md-3">
                    <div class="bg-white p-4 mb-4" style="border-radius: 5px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                        <h3 class="text-black mb-4 h5 font-weight-bold">Menu</h3>
                        <ul class="list-unstyled">
                            <li class="mb-2"><a href="{{ route('admin.dashboard_admin') }}"
                                    class="d-block {{ request()->routeIs('admin.dashboard_admin') ? 'text-primary font-weight-bold' : 'text-secondary' }}">Overview</a>
                            </li>
                            <li class="mb-2"><a href="{{ route('admin.trips.index') }}"
                                    class="d-block {{ request()->routeIs('admin.trips.*') ? 'text-primary font-weight-bold' : 'text-secondary' }}">Manage
                                    Trips</a></li>
                            <li class="mb-2"><a href="{{ route('admin.posts.index') }}"
                                    class="d-block {{ request()->routeIs('admin.posts.*') ? 'text-primary font-weight-bold' : 'text-secondary' }}">Blog
                                    Moderation <span
                                        class="badge badge-danger float-right">{{ \App\Models\Post::where('status', 'pending')->count() }}</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

                {{-- MAIN CONTENT AREA --}}
                <div class="col-md-9">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    @yield('admin_content')
                </div>
            </div>
        </div>
    </div>
@endsection
