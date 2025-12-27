@extends('layouts.guest')

@section('title', 'Register &mdash; Trips Travel')

@push('styles')
    <style>
        .register-card {
            background: rgba(255, 255, 255, 0.85);
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .site-section-cover.overlay {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@section('content')
    <div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 100vh;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="register-card">
                        <div class="heading-39101 text-center mb-4">
                            <span class="subtitle-39191">Join Us</span>
                            <h3 class="mb-3">Create Account</h3>
                        </div>

                        <form action="#" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="name">Full Name</label>
                                    <input type="text" id="name" class="form-control" placeholder="Your Full Name"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label for="email">Email Address</label>
                                    <input type="email" id="email" class="form-control" placeholder="example@mail.com"
                                        required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="password">Password</label>
                                    <input type="password" id="password" class="form-control" placeholder="Password"
                                        required>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="password" id="confirm_password" class="form-control"
                                        placeholder="Re-type Password" required>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-block text-muted py-3 px-4">
                                    Register Now
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="small text-muted">Already have an account? <a href="{{ route('login_page') }}"
                                        class="text-primary">Login here</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
