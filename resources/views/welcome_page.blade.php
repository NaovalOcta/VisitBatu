@extends('layouts.app')

@section('title', 'Trips &mdash; Website Template by Colorlib')

@section('content')
    <div class="ftco-blocks-cover-1">
        <div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}')">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5" data-aos="fade-right">
                        <h1 class="mb-3 text-white">Let's Enjoy The Wonders of Nature</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Soluta veritatis in tenetur doloremque,
                            maiores doloribus officia iste. Dolores.</p>
                        <p class="d-flex align-items-center">
                            <a href="https://vimeo.com/191947042" data-fancybox class="play-btn-39282 mr-3"><span
                                    class="icon-play"></span></a>
                            <span class="small">Watch the video</span>
                        </p>
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
                @foreach ([['img' => 'img_1.jpg', 'price' => '$200.00', 'title' => 'Dignissimos debitis'], ['img' => 'img_2.jpg', 'price' => '$390.00', 'title' => 'Consectetur adipisicing'], ['img' => 'img_3.jpg', 'price' => '$180.00', 'title' => 'Temporibus aperiam'], ['img' => 'img_4.jpg', 'price' => '$600.00', 'title' => 'Expedita fugiat'], ['img' => 'img_5.jpg', 'price' => '$330.00', 'title' => 'Consectetur adipisicing'], ['img' => 'img_6.jpg', 'price' => '$450.00', 'title' => 'Consectetur Amet']] as $trip)
                    <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up">
                        <div class="listing-item">
                            <div class="listing-image">
                                <img src="{{ asset('images/' . $trip['img']) }}" alt="Image" class="img-fluid">
                            </div>
                            <div class="listing-item-content">
                                <a class="px-3 mb-3 category bg-primary" href="#">{{ $trip['price'] }}</a>
                                <h2 class="mb-1"><a href="trip-single.html">{{ $trip['title'] }}</a></h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="site-section bg-image overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}')">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-7 text-center">
                    <h2 class="font-weight-bold text-white">Join and Trip With Us</h2>
                    <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus ut, doloremque
                        quo molestiae nesciunt officiis veniam, beatae dignissimos!</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary text-white py-3 px-4">Get In Touch</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
