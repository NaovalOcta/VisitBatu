@extends('layouts.guest')

@section('content')
    <div class="w-full max-w-md bg-white rounded-3xl shadow-2xl overflow-hidden p-8 md:p-12 m-4">
        <div class="text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>

            <h1 class="font-serif text-2xl md:text-3xl font-bold text-gray-900 mb-4">Verifikasi Email Anda</h1>

            <p class="text-gray-600 mb-6 leading-relaxed">
                Terima kasih sudah mendaftar! Sebelum memulai, mohon verifikasi email Anda dengan mengklik link yang telah
                kami kirimkan ke:
            </p>

            <p class="text-primary-700 font-bold mb-6">{{ Auth::user()->email }}</p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit"
                        class="w-full bg-primary-900 text-white font-bold py-3 px-6 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-gray-500 font-medium hover:text-gray-700 transition text-sm">
                        Logout
                    </button>
                </form>
            </div>

            <p class="mt-8 text-xs text-gray-400">
                Tidak menerima email? Cek folder spam Anda atau hubungi
                <a href="{{ route('contact_page') }}" class="text-primary-600 hover:underline">support kami</a>.
            </p>
        </div>
    </div>
@endsection
