@extends('layouts.guest')

@section('title', 'Login &mdash; Trips Travel')

@push('styles')
    <style>
        .login-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .site-section-cover.overlay {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5" data-aos="fade-up">

                    <div class="text-center mb-4">
                        <a href="{{ route('welcome_page') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="Image" class="img-fluid"
                                style="max-width: 150px;">
                        </a>
                    </div>

                    <div class="login-card">
                        <div class="heading-39101 text-center mb-4">
                            <span class="subtitle-39191">Welcome Back</span>
                            <h3 class="mb-3">User Login</h3>
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" class="form-control" placeholder="example@mail.com"
                                    required>
                            </div>

                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Your Password"
                                    required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block text-muted py-3 px-4">
                                    Login
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="small text-muted">Don't have an account? <a href="{{ route('register_page') }}"
                                        class="text-primary">Register here</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
