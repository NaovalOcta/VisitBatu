@extends('layouts.app')

@section('title', 'About Us &mdash; Trips')

@section('content')
    <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}')">
            <div class="container">
                <div class="row align-items-center justify-content-center text-center">
                    <div class="col-md-5" data-aos="fade-up">
                        <h1 class="mb-3 text-white">About Us</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta veritatis in tenetur doloremque,
                            maiores doloribus officia iste. Dolores.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="heading-39101 mb-5">
                        <span class="backdrop">Story</span>
                        <span class="subtitle-39191">Discover Story</span>
                        <h3>Our Story</h3>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Animi quae expedita fugiat quo incidunt,
                        possimus temporibus aperiam eum, quaerat sapiente.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dignissimos debitis enim a pariatur
                        molestiae.</p>
                </div>
                <div class="col-md-6" data-aos="fade-right">
                    <img src="{{ asset('images/traveler.jpg') }}" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

@endsection
