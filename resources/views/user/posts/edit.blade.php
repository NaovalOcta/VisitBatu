@extends('layouts.app')

@section('title', 'Edit Blog - iFurnish')

@section('content')
<div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 250px;">
    <div class="container text-center" style="height: 250px; display: flex; align-items: center; justify-content: center;">
        <h1 class="text-white font-weight-bold">Edit Blog: {{ $post->title }}</h1>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white p-5 shadow-sm rounded">
                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- PENTING: Untuk update gunakan method PUT --}}

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold">Judul Blog</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold">Foto Sampul (Biarkan kosong jika tidak ingin ganti)</label>
                            @if($post->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $post->image) }}" width="150" class="rounded shadow-sm">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror">
                        </div>

                        <div class="form-group mb-4">
                            <label class="text-black font-weight-bold">Konten Blog</label>
                            <textarea name="content" cols="30" rows="10" class="form-control @error('content') is-invalid @enderror">{{ old('content', $post->content) }}</textarea>
                            @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-warning px-5 py-3 text-white font-weight-bold">
                                Simpan Perubahan
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
