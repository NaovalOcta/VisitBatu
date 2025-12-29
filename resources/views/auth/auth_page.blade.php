@extends('layouts.guest')

@section('content')
    <div x-data="{ isSignUp: {{ json_encode(($isSignUp ?? false) || session('error_register') || $errors->has('name')) }} }"
        class="relative w-full max-w-[1000px] min-h-[600px] bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:block m-4">

        <div class="absolute top-0 left-0 h-full w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 bg-white transition-all duration-700 ease-in-out"
            :class="isSignUp ? 'md:translate-x-full opacity-100 z-20' : 'opacity-0 z-0 pointer-events-none'">

            <form action="{{ route('register') }}" method="POST" class="w-full max-w-sm text-center">
                @csrf
                <h1 class="font-serif text-3xl font-bold text-gray-900 mb-4">Create Account</h1>

                <div class="flex justify-center gap-4 mb-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-50 transition">G</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-50 transition">f</a>
                </div>
                <span class="text-xs text-gray-400 mb-6 block">atau gunakan email untuk pendaftaran</span>

                <div class="space-y-3 text-left">
                    <div>
                        <input type="text" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('name') border-red-500 bg-red-50 @enderror">
                        @error('name')
                            <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('email') border-red-500 bg-red-50 @enderror">
                        @error('email')
                            <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition @error('password') border-red-500 bg-red-50 @enderror">
                        @error('password')
                            <p class="text-[10px] text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <input type="password" name="password_confirmation" placeholder="Ulangi Password" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition">
                    </div>
                </div>

                <button
                    class="mt-6 bg-primary-900 text-white font-bold py-3 px-12 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1">
                    Sign Up
                </button>

                <p class="mt-6 text-sm md:hidden">Sudah punya akun? <button type="button" @click="isSignUp = false"
                        class="text-primary-700 font-bold">Login</button></p>
            </form>
        </div>

        <div class="absolute top-0 left-0 h-full w-full md:w-1/2 flex items-center justify-center p-8 md:p-12 bg-white transition-all duration-700 ease-in-out"
            :class="isSignUp ? 'md:translate-x-full opacity-0 z-0 pointer-events-none' : 'opacity-100 z-20'">

            <form action="{{ route('login') }}" method="POST" class="w-full max-w-sm text-center">
                @csrf
                <div class="flex justify-center mb-6">
                    <div
                        class="w-12 h-12 bg-primary-100 text-primary-800 rounded-lg flex items-center justify-center shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                        </svg>
                    </div>
                </div>

                <h1 class="font-serif text-3xl font-bold text-gray-900 mb-4">Sign In</h1>

                <div class="flex justify-center gap-4 mb-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-50 transition">G</a>
                    <a href="#"
                        class="w-10 h-10 rounded-full border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-primary-50 transition">f</a>
                </div>
                <span class="text-xs text-gray-400 mb-6 block">atau gunakan akun email anda</span>

                <div class="space-y-4 text-left">
                    <div>
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition">
                    </div>
                    <div>
                        <input type="password" name="password" placeholder="Password" required
                            class="w-full bg-gray-50 border border-gray-200 px-4 py-3 rounded-xl focus:ring-2 focus:ring-primary-500 outline-none transition">
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4 mb-6 text-xs">
                    <label class="flex items-center text-gray-500 cursor-pointer">
                        <input type="checkbox" name="remember" class="mr-2 text-primary-600 rounded focus:ring-primary-500">
                        Ingat saya
                    </label>
                    <a href="#" class="font-bold text-gray-900 hover:text-primary-700">Lupa Password?</a>
                </div>

                <button
                    class="bg-primary-900 text-white font-bold py-3 px-12 rounded-full hover:bg-primary-800 transition shadow-lg transform hover:-translate-y-1">
                    Sign In
                </button>

                <p class="mt-6 text-sm md:hidden">Belum punya akun? <button type="button" @click="isSignUp = true"
                        class="text-primary-700 font-bold">Daftar</button></p>
            </form>
        </div>

        <div class="hidden md:block absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-transform duration-700 ease-in-out z-50"
            :class="isSignUp ? '-translate-x-full rounded-r-[3rem] rounded-l-none' :
                'translate-x-0 rounded-l-[3rem] rounded-r-none'">

            <div class="bg-primary-900 text-white relative -left-full h-full w-[200%] transform transition-transform duration-700 ease-in-out"
                :class="isSignUp ? 'translate-x-1/2' : 'translate-x-0'">

                <div class="absolute inset-0 bg-cover bg-center opacity-40 mix-blend-overlay"
                    style="background-image: url('https://images.unsplash.com/photo-1533282960533-51328aa49826?q=80&w=2442&auto=format&fit=crop');">
                </div>

                <div class="absolute top-0 w-1/2 h-full flex flex-col items-center justify-center p-12 text-center transform transition-transform duration-700 ease-in-out"
                    :class="isSignUp ? 'translate-x-0' : '-translate-x-[20%]'">
                    <h1 class="font-serif text-4xl font-bold mb-4">Welcome Back!</h1>
                    <p class="text-primary-100 mb-8 font-light leading-relaxed">
                        Sudah memiliki akun? Masuk sekarang untuk melanjutkan perjalananmu di Kota Batu.
                    </p>
                    <button
                        class="bg-transparent border-2 border-white text-white font-bold py-3 px-10 rounded-full hover:bg-white hover:text-primary-900 transition shadow-lg"
                        @click="isSignUp = false">
                        Sign In
                    </button>
                </div>

                <div class="absolute top-0 right-0 w-1/2 h-full flex flex-col items-center justify-center p-12 text-center transform transition-transform duration-700 ease-in-out"
                    :class="isSignUp ? 'translate-x-[20%]' : 'translate-x-0'">
                    <h1 class="font-serif text-4xl font-bold mb-4">New Here?</h1>
                    <p class="text-primary-100 mb-8 font-light leading-relaxed">
                        Daftarkan dirimu dan temukan keindahan tersembunyi bersama ribuan traveler lainnya.
                    </p>
                    <button
                        class="bg-transparent border-2 border-white text-white font-bold py-3 px-10 rounded-full hover:bg-white hover:text-primary-900 transition shadow-lg"
                        @click="isSignUp = true">
                        Sign Up
                    </button>
                </div>

            </div>
        </div>
    </div>
@endsection
