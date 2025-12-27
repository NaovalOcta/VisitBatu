@extends('layouts.app')

@section('title', 'Trips List &mdash; Trips')

@section('content')
<div class="ftco-blocks-cover-1">
    <div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}')">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-md-5" data-aos="fade-up">
                    <h1 class="mb-3 text-white">Trips List</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta veritatis in tenetur doloremque, maiores doloribus officia iste. Dolores.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="site-section">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-md-7">
                <div class="heading-39101 mb-5">
                    <span class="backdrop text-center">Journey</span>
                    <span class="subtitle-39191">Journey</span>
                    <h3>Your Journey Starts Here</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                <div class="listing-item">
                    <div class="listing-image">
                        <img src="{{ asset('images/img_1.jpg') }}" alt="Image" class="img-fluid">
                    </div>
                    <div class="listing-item-content">
                        <a class="px-3 mb-3 category bg-primary" href="#">$200.00</a>
                        <h2 class="mb-1"><a href="trip-single.html">Dignissimos debitis</a></h2>
                    </div>
                </div>
            </div>
            </div>
    </div>
</div>
@endsection
