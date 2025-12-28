@extends('layouts.app')

@section('title', 'Create New Blog - iFurnish')

@section('content')
<div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 250px;">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center" style="height: 250px;">
            <div class="col-md-10">
                <h1 class="text-white font-weight-bold">Tulis Blog Baru</h1>
                <p class="text-white">Bagikan pengalaman perjalanan Anda kepada dunia.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white p-5 shadow-sm rounded">
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold" for="title">Judul Blog</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan judul yang menarik..." value="{{ old('title') }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold" for="image">Foto Sampul</label>
                            <input type="file" name="image" id="image" class="form-control-file @error('image') is-invalid @enderror">
                            <small class="text-muted">Format: JPG, PNG, JPEG (Maks. 2MB)</small>
                            @error('image') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold" for="content">Konten Blog</label>
                            <textarea name="content" id="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror" placeholder="Tulis cerita Anda di sini...">{{ old('content') }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary px-5 py-3 text-white font-weight-bold">
                                <i class="fa-solid fa-paper-plane mr-2"></i> Publikasikan Blog
                            </button>
                            <a href="{{ route('user.dashboard_user') }}" class="btn btn-outline-secondary px-5 py-3 ml-2">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
