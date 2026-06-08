@extends('layouts.guest')

@section('content')
    <div x-data="{ isLoading: false }" class="w-full max-w-md bg-white dark:bg-night-800 rounded-3xl shadow-2xl dark:shadow-night-950/50 overflow-hidden p-8 md:p-12 m-4 transition-colors duration-300">
        <div class="text-center">
            {{-- Icon --}}
            <div class="mx-auto w-16 h-16 bg-primary-100 dark:bg-night-900 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary-600 dark:text-primary-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>

            <h1 class="font-serif text-2xl md:text-3xl font-bold text-gray-900 dark:text-white mb-4">Reset Password</h1>

            <p class="text-gray-600 dark:text-white/60 mb-8 leading-relaxed">
                Silakan masukkan password baru Anda di bawah ini.
            </p>

            <form method="POST" action="{{ route('password.update') }}" class="space-y-6" @submit="isLoading = true">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">

                <div class="text-left">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ $email ?? old('email') }}" required
                        autofocus
                        class="w-full bg-gray-50 dark:bg-night-900 border border-gray-200 dark:border-night-700 text-gray-800 dark:text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('email') border-red-500 bg-red-50 dark:bg-red-900/20 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-left">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Password Baru</label>
                    <input type="password" name="password" id="password" required
                        class="w-full bg-gray-50 dark:bg-night-900 border border-gray-200 dark:border-night-700 text-gray-800 dark:text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('password') border-red-500 bg-red-50 dark:bg-red-900/20 @enderror">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-left">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-white/80 mb-2">Konfirmasi
                        Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                        class="w-full bg-gray-50 dark:bg-night-900 border border-gray-200 dark:border-night-700 text-gray-800 dark:text-white px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition">
                </div>

                <button type="submit" :disabled="isLoading"
                    class="w-full bg-primary-900 text-white font-bold py-3 px-6 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1 disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!isLoading">Reset Password</span>
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
        </div>
    </div>
@endsection
