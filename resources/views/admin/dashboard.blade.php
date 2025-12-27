@extends('admin.layout')

{{-- Pastikan nama section ini sesuai dengan layout Anda ('content' atau 'admin_content') --}}
@section('admin_content')
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h2 class="fw-bold text-dark">Dashboard Pengelola</h2>
            <p class="text-muted mb-0">Selamat datang kembali! Berikut ringkasan konten website Anda.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="icon-plus me-2"></i> Tambah Wisata Baru
            </a>
        </div>
    </div>

    {{-- Row Statistik Utama --}}
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-primary bg-opacity-10 p-4 rounded-circle me-4">
                        <span class="icon-map text-primary display-6"></span>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted small fw-bold mb-1">Destinasi Wisata</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $totalTrips }}</h2>
                        <small class="text-muted">Tempat wisata terdaftar</small>
                    </div>
                    <div class="ms-auto">
                        <a href="{{ route('admin.trips.index') }}"
                            class="btn btn-outline-primary btn-sm rounded-pill">Kelola</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="icon-box bg-warning bg-opacity-10 p-4 rounded-circle me-4">
                        <span class="icon-chat text-warning display-6"></span>
                    </div>
                    <div>
                        <h6 class="text-uppercase text-muted small fw-bold mb-1">Menunggu Review</h6>
                        <h2 class="fw-bold mb-0 text-dark">{{ $pendingPosts }}</h2>
                        <small class="text-muted">Postingan cerita pengguna</small>
                    </div>
                    @if ($pendingPosts > 0)
                        <div class="ms-auto">
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Perlu Tindakan</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Row Tabel Moderasi --}}
    <div class="row mt-2">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div
                    class="card-header bg-white border-bottom-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold text-dark mb-0">Antrian Moderasi Blog</h5>
                    <a href="{{ route('admin.posts.index') }}" class="text-decoration-none small fw-bold">Lihat Semua
                        &rarr;</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0"
                            style="border-collapse: separate; border-spacing: 0;">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 border-0 small text-uppercase text-muted fw-bold">Judul Cerita</th>
                                    <th class="border-0 small text-uppercase text-muted fw-bold">Penulis</th>
                                    <th class="border-0 small text-uppercase text-muted fw-bold">Tanggal Upload</th>
                                    <th class="px-4 border-0 small text-uppercase text-muted fw-bold text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($moderationQueue as $post)
                                    <tr>
                                        <td class="px-4 py-3">
                                            <div class="fw-bold text-dark">{{ Str::limit($post->title, 40) }}</div>
                                            <small class="text-muted">{{ Str::limit(strip_tags($post->body), 50) }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary bg-opacity-25 rounded-circle d-flex align-items-center justify-content-center text-secondary fw-bold"
                                                    style="width: 35px; height: 35px; font-size: 0.8rem;">
                                                    {{ substr($post->user->name ?? 'U', 0, 1) }}
                                                </div>
                                                <span class="ms-2 fw-medium">{{ $post->user->name ?? 'Pengguna' }}</span>
                                            </div>
                                        </td>
                                        <td class="text-muted small">
                                            <i class="icon-calendar me-1"></i> {{ $post->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-4 text-end">
                                            <a href="{{ route('admin.posts.index') }}"
                                                class="btn btn-sm btn-primary rounded-pill px-3">
                                                Review
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <div class="text-muted d-flex flex-column align-items-center">
                                                <i class="icon-check_circle display-4 text-success opacity-25 mb-3"></i>
                                                <span class="fw-medium">Semua aman! Tidak ada postingan yang menunggu
                                                    moderasi.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
