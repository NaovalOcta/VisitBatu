@extends('layouts.app')

@section('title', 'My Dashboard - iFurnish')

@section('content')
<div class="site-section-cover overlay" style="background-image: url('{{ asset('images/hero_1.jpg') }}'); height: 350px;">
    <div class="container">
        <div class="row align-items-center justify-content-center text-center" style="height: 350px;">
            <div class="col-md-10">
                <h1 class="text-white font-weight-bold">User Dashboard</h1>
                <p class="text-white">Kelola akun dan aktivitas Anda di sini.</p>
            </div>
        </div>
    </div>
</div>

<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            {{-- Sidebar Profil --}}
            <div class="col-lg-4">
                <div class="bg-white p-4 shadow-sm rounded text-center">
                    {{-- Mengambil nama untuk avatar, pastikan variabel $user tersedia --}}
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=F58727&color=fff&size=100"
                        class="rounded-circle mb-3 shadow-sm" alt="Profile">

                    <h4 class="text-black font-weight-bold mb-0">{{ $user->name }}</h4>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    {{-- Menampilkan Role dari Database --}}
                    <div class="badge badge-primary px-3 py-2 mb-3">Status: {{ ucfirst($user->role) }}</div>

                    <hr>
                    <div class="text-left">
                        <p class="mb-1"><strong>Bergabung sejak:</strong></p>
                        {{-- Menggunakan format tanggal dari kolom created_at --}}
                        <p class="text-muted small">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : 'Tanggal tidak tersedia' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Statistik & Aktivitas --}}
            <div class="col-lg-8">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="bg-white p-4 shadow-sm rounded border-left border-primary" style="border-left: 5px solid #F58727 !important;">
                            <span class="text-muted small text-uppercase font-weight-bold">Blog Posts</span>
                            <h2 class="mb-0 font-weight-bold">0</h2>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white p-4 shadow-sm rounded border-left border-info" style="border-left: 5px solid #17a2b8 !important;">
                            <span class="text-muted small text-uppercase font-weight-bold">Saved Trips</span>
                            <h2 class="mb-0 font-weight-bold">0</h2>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-5 shadow-sm rounded">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="text-black font-weight-bold mb-0">History Blog Saya</h5>
                    </div>
                    <div class="row">
                        @forelse($posts as $post)
                            <div class="col-md-6 mb-4">
                                <div class="card border-0 shadow-sm h-100" style="transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'">
                                    @if($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 150px; object-fit: cover; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 150px; border-top-left-radius: 5px; border-top-right-radius: 5px;">
                                            <i class="fa-solid fa-image text-muted fa-2x"></i>
                                        </div>
                                    @endif
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title font-weight-bold text-black mb-0">{{ Str::limit($post->title, 40) }}</h6>
                                            <span class="badge {{ $post->status === 'approved' ? 'badge-success' : 'badge-warning' }} small">
                                                {{ ucfirst($post->status) }}
                                            </span>
                                        </div>
                                        <p class="text-muted small mb-3">{{ Str::limit(strip_tags($post->content), 80) }}</p>
                                        <span class="text-muted small"><i class="fa-solid fa-calendar-days mr-4 mb-4"></i> {{ $post->created_at->format('d M Y') }}</span>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-info btn-sm">
                                                <i class="fa-brands fa-blogger"></i>
                                            </a> {{-- {{ route('blog-page', $post->slug) }} --}}
                                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-warning btn-sm ml-1">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus blog ini? Tindakan ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="fa-solid fa-folder-open text-muted fa-3x mb-3"></i>
                                <p class="text-muted">Anda belum pernah membuat blog.</p>
                            </div>
                        @endforelse

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                                <i class="fa-solid fa-circle-check mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection
