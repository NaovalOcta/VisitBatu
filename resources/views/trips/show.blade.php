@extends('layouts.app')

@section('title', $trip->title . ' - VisitBatu')

@section('content')
    {{-- 1. HERO SECTION (Konsisten dengan trips_page) --}}
    <div class="relative bg-primary-900 pt-32 pb-32 overflow-hidden">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-accent-500 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center text-center">
                {{-- Breadcrumb Sederhana --}}
                <div class="flex items-center gap-2 text-primary-100 text-sm mb-6 font-medium tracking-wide">
                    <a href="/" class="hover:text-white transition">Home</a>
                    <span class="opacity-50">/</span>
                    <a href="{{ route('trips-page.index') }}" class="hover:text-white transition">Destinasi</a>
                    <span class="opacity-50">/</span>
                    <span class="text-accent-400">{{ $trip->title }}</span>
                </div>

                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $trip->title }}
                </h1>

                <div class="flex items-center gap-4 text-white/80 text-sm md:text-base">
                    <span class="flex items-center gap-2">
                        <i class="icon-map-marker text-accent-400"></i> {{ $trip->location }}
                    </span>
                    <span class="w-1.5 h-1.5 rounded-full bg-accent-400"></span>
                    <span class="flex items-center gap-2">
                        <i class="icon-folder text-accent-400"></i> {{ $trip->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MAIN CONTENT (Grid Layout) --}}
    <div class="bg-gray-50 min-h-screen relative -mt-16 pb-20 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- KOLOM KIRI: Konten Utama (Gambar & Deskripsi) --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Main Image --}}
                    <div class="bg-white p-2 mt-5 rounded-4xl shadow-xl">
                        <div class="relative aspect-video rounded-3xl overflow-hidden">
                            <img src="{{ Str::startsWith($trip->thumbnail, 'http') ? $trip->thumbnail : asset('storage/' . $trip->thumbnail) }}"
                                alt="{{ $trip->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-700">
                        </div>
                    </div>

                    {{-- Deskripsi Text --}}
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="font-serif text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-primary-600 rounded-full block"></span>
                            Tentang Destinasi
                        </h3>

                        <div class="prose prose-lg text-gray-600 leading-relaxed font-sans max-w-none">
                            {!! nl2br(e($trip->description)) !!}
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Sidebar Sticky (Info & Booking) --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-6">

                        {{-- Card Informasi Harga --}}
                        <div
                            class="bg-white rounded-3xl p-8 mt-5 shadow-lg border border-gray-100 relative overflow-hidden group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-primary-50 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-primary-100">
                            </div>

                            <p class="text-sm text-gray-500 font-bold uppercase tracking-wider mb-2">Harga Tiket Masuk</p>
                            <div class="flex items-baseline gap-1 mb-6">
                                <span class="text-sm text-gray-400 font-bold">IDR</span>
                                <span
                                    class="text-4xl font-bold text-primary-700">{{ number_format($trip->price, 0, ',', '.') }}</span>
                            </div>

                            <hr class="border-dashed border-gray-200 mb-6">

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 shrink-0">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase">Jam Buka / Durasi</p>
                                        <p class="text-gray-800 font-medium">{{ $trip->duration }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 shrink-0">
                                        <i class="fa-regular fa-map"></i>>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 font-bold uppercase">Lokasi</p>
                                        <p class="text-gray-800 font-medium">{{ $trip->location }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Booking (Bisa diarahkan ke WA) --}}
                            {{-- <a href="#"
                                class="block w-full py-4 bg-gray-900 text-white font-bold text-center rounded-xl hover:bg-primary-600 transition shadow-lg hover:shadow-primary-500/30 transform hover:-translate-y-1">
                                Booking Sekarang
                            </a>
                            <p class="text-xs text-center text-gray-400 mt-4">Konfirmasi instan & pembayaran aman.</p> --}}
                        </div>

                        {{-- Card Bantuan (Optional) --}}
                        <div class="bg-primary-900 rounded-3xl p-8 text-center text-white relative overflow-hidden">
                            <div class="absolute inset-0 bg-pattern opacity-10"></div>
                            <h4 class="font-serif text-xl font-bold mb-2 relative z-10">Butuh Bantuan?</h4>
                            <p class="text-primary-100 text-sm mb-6 relative z-10">Hubungi tim kami untuk info lebih lanjut.
                            </p>
                            <a href="{{ route('contact_page') }}"
                                class="inline-block px-6 py-2 bg-white text-primary-900 font-bold rounded-full text-sm hover:bg-accent-400 hover:text-white transition relative z-10">
                                Hubungi Kami
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
