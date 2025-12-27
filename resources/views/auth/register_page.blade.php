@extends('layouts.guest')

@section('title', 'Register — Trips Travel')

@push('styles')
    <style>
        .register-card {
            background: rgba(255, 255, 255, 0.95);
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

        .invalid-feedback {
            font-size: 0.875em;
            font-weight: bold;
            display: block;
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

                        <form action="{{ route('register') }}" method="POST">
                            @csrf

                            {{-- Nama Lengkap --}}
                            <div class="form-group mb-3">
                                <label for="name" class="font-weight-bold text-dark">Full Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Your Full Name"
                                    value="{{ old('name') }}" {{-- Agar tidak capek ngetik ulang --}} required>

                                @error('name')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group mb-3">
                                <label for="email" class="font-weight-bold text-dark">Email Address</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="example@mail.com"
                                    value="{{ old('email') }}" required>

                                @error('email')
                                    <div class="invalid-feedback text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Password Row --}}
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="password" class="font-weight-bold text-dark">Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                        required>

                                    @error('password')
                                        <div class="invalid-feedback text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 form-group mb-3">
                                    <label for="confirm_password" class="font-weight-bold text-dark">Confirm
                                        Password</label>
                                    {{-- Name harus password_confirmation --}}
                                    <input type="password" name="password_confirmation" id="confirm_password"
                                        class="form-control" placeholder="Re-type Password" required>
                                </div>
                            </div>

                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary btn-block text-white py-3 px-4 shadow">
                                    Register Now
                                </button>
                            </div>

                            <div class="text-center mt-4">
                                <p class="small text-muted">Already have an account? <a href="{{ route('login') }}"
                                        class="text-primary font-weight-bold">Login here</a></p>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
