@extends('layouts.app')

@section('title', $post->title . ' - iFurnish')

@section('content')
{{-- Hero Section --}}
<div class="site-section-cover overlay" style="background-image: url('{{ $post->image ? asset('storage/' . $post->image) : asset('images/hero_1.jpg') }}'); height: 400px;">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center" style="height: 400px;">
            <div class="col-md-10">
                <span class="text-white small text-uppercase font-weight-bold">
                    <i class="fa-solid fa-calendar-days mr-2"></i> {{ $post->created_at->format('d M Y') }}
                </span>
                <h1 class="text-white font-weight-bold display-4">{{ $post->title }}</h1>
                <p class="text-white">Oleh: <strong>{{ $post->user->name }}</strong></p>
            </div>
        </div>
    </div>
</div>

{{-- Content Section --}}
<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="bg-white p-5 shadow-sm rounded">

                    {{-- Badge Status (Hanya terlihat jika pemilik yang melihat atau admin) --}}
                    @auth
                        @if(Auth::id() == $post->user_id)
                        <div class="mb-4">
                            <span class="badge {{ $post->status === 'approved' ? 'badge-success' : 'badge-warning' }} p-2">
                                Status Post: {{ ucfirst($post->status) }}
                            </span>
                        </div>
                        @endif
                    @endauth

                    {{-- Isi Blog --}}
                    <div class="blog-content text-black" style="line-height: 1.8; font-size: 1.1rem;">
                        {!! nl2br(e($post->content)) !!}
                    </div>

                    <hr class="my-5">

                    {{-- Footer Detail --}}
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.dashboard_user') }}" class="btn btn-outline-primary">
                            <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Dashboard
                        </a>

                        <div class="share-buttons">
                            <span class="text-muted small mr-2">Bagikan:</span>
                            <a href="#" class="text-info mr-2"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#" class="text-info mr-2"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#" class="text-danger"><i class="fa-brands fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
