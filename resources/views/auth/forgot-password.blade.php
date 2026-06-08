@extends('layouts.guest')

@section('content')
    <div x-data="{ isLoading: false }" class="w-full max-w-md bg-white dark:bg-night-800 rounded-3xl shadow-2xl dark:shadow-night-950/50 overflow-hidden p-8 md:p-12 m-4 transition-colors duration-300">
        <div class="text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 bg-primary-100 dark:bg-night-900 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                </svg>
            </div>

            <h1 class="font-serif text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">Lupa Password?</h1>

            <p class="text-gray-600 dark:text-white/60 mb-8 leading-relaxed">
                Jangan khawatir. Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.
            </p>

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 dark:bg-green-900/20 dark:border-green-800 dark:text-green-300 px-4 py-3 rounded-xl mb-6 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6" @submit="isLoading = true">
                @csrf

                <div class="text-left">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full bg-gray-50 dark:bg-night-900 border border-gray-200 dark:border-night-700 text-gray-800 dark:text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('email') border-red-500 bg-red-50 dark:bg-red-900/20 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" :disabled="isLoading"
                    class="w-full bg-primary-900 text-white font-bold py-3 px-6 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!isLoading">Kirim Link Reset</span>
                    <span x-show="isLoading" class="flex items-center justify-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                        Processing...
                    </span>
                </button>
            </form>

            <div class="mt-8 pt-6 border-t border-gray-100 dark:border-night-700">
                <a href="{{ route('login') }}"
                    class="text-primary-700 dark:text-primary-400 font-bold hover:text-primary-900 dark:hover:text-primary-300 text-sm transition">
                    Kembali ke halaman login
                </a>
            </div>
        </div>
    </div>
@endsection
