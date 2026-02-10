@extends('layouts.guest')

@section('content')
    <div class="text-center p-8 max-w-lg">
        {{-- Illustration / Icon --}}
        <div class="flex justify-center mb-8">
            <div class="w-32 h-32 bg-teal-100 rounded-full flex items-center justify-center animate-pulse">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-teal-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <h1 class="font-serif text-6xl font-bold text-gray-900 mb-4">429</h1>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Terlalu Banyak Permintaan</h2>

        <p class="text-gray-500 mb-8 leading-relaxed">
            Maaf, sistem mendeteksi terlalu banyak aktivitas dari perangkat Anda.
            Silakan tunggu sekitar satu menit sebelum mencoba kembali untuk keamanan akun Anda.
        </p>

        <a href="{{ url('/') }}"
            class="inline-flex items-center justify-center px-8 py-3 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-full shadow-lg hover:shadow-teal-500/30 transition-all transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Kembali ke Beranda
        </a>

        {{-- Optional Footer --}}
        <div class="mt-12 text-gray-400 text-sm italic">
            VisitBatu - Keamanan Sistem & Kenyamanan Pengguna
        </div>
    </div>
@endsection
