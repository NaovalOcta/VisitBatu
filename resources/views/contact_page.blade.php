@extends('layouts.app')

@section('title', 'Hubungi Kami - VisitBatu')

@section('content')
    {{-- 1. HERO SECTION (Konsisten dengan Trips Page) --}}
    <div class="relative bg-primary-900 pt-32 pb-32 overflow-hidden">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-accent-500 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="text-accent-400 font-bold tracking-widest uppercase text-sm mb-4 inline-block">
                Bantuan & Dukungan
            </span>
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                Hubungi Kami
            </h1>
            <p class="text-primary-100 text-lg max-w-2xl mx-auto">
                Punya pertanyaan seputar destinasi wisata di Batu? Atau ingin merencanakan perjalanan khusus? Tim kami siap
                membantu Anda.
            </p>
        </div>
    </div>

    {{-- 2. MAIN CONTENT --}}
    <div class="bg-gray-50 min-h-screen relative mt-16 pb-20 z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- KOLOM KIRI: Informasi Kontak (Info Cards) --}}
                <div class="lg:col-span-1 space-y-6">

                    {{-- Card Info --}}
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-start gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-xl shrink-0">
                                <i class="icon-map-marker"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Kantor Pusat</h4>
                                <p class="text-gray-500 text-sm mt-1">Jl. Raya Pandanrejo No. 99<br>Batu, Jawa Timur,
                                    Indonesia</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 mb-6">
                            <div
                                class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-xl shrink-0">
                                <i class="icon-envelope"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Email</h4>
                                <p class="text-gray-500 text-sm mt-1">
                                    <a href="mailto:hello@visitbatu.com"
                                        class="hover:text-primary-600 transition">hello@visitbatu.com</a>
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div
                                class="w-12 h-12 rounded-full bg-primary-50 flex items-center justify-center text-primary-600 text-xl shrink-0">
                                <i class="icon-phone"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-lg">Telepon / WA</h4>
                                <p class="text-gray-500 text-sm mt-1">+62 812 3456 7890</p>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div class="bg-primary-900 rounded-3xl p-8 text-white text-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-pattern opacity-10"></div>
                        <h4 class="font-serif text-xl font-bold mb-4 relative z-10">Ikuti Perjalanan Kami</h4>
                        <div class="flex justify-center gap-4 relative z-10">
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent-500 hover:text-white transition">
                                <img src="https://cdn.simpleicons.org/instagram/white"
                                    class="w-4 h-4 opacity-70 hover:opacity-100">
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent-500 hover:text-white transition">
                                <img src="https://cdn.simpleicons.org/facebook/white"
                                    class="w-4 h-4 opacity-70 hover:opacity-100">
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent-500 hover:text-white transition">
                                <img src="https://cdn.simpleicons.org/x/white" class="w-4 h-4 opacity-70 hover:opacity-100">
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full bg-white/10 flex items-center justify-center hover:bg-accent-500 hover:text-white transition">
                                <img src="https://cdn.simpleicons.org/youtube/white"
                                    class="w-4 h-4 opacity-70 hover:opacity-100">
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: Formulir Kontak --}}
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl p-8 md:p-10 shadow-xl border-t-4 border-primary-600">
                        <h3 class="font-serif text-3xl font-bold text-gray-800 mb-2">Kirim Pesan</h3>
                        <p class="text-gray-500 mb-8">Silakan isi formulir di bawah ini, kami akan merespons secepatnya.</p>

                        {{-- Alert Sukses --}}
                        @if (session('success'))
                            <div class="mb-8 p-4 rounded-xl bg-primary-50 border border-primary-200 flex items-start gap-3">
                                <i class="icon-check-circle text-primary-600 mt-1"></i>
                                <div>
                                    <h4 class="font-bold text-primary-800">Berhasil!</h4>
                                    <p class="text-primary-600 text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama --}}
                                <div>
                                    <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        placeholder="Contoh: Budi Santoso"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition outline-none @error('name') border-red-500 bg-red-50 @enderror">
                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div>
                                    <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat
                                        Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        placeholder="nama@email.com"
                                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition outline-none @error('email') border-red-500 bg-red-50 @enderror">
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- Subjek --}}
                            <div>
                                <label for="subject" class="block text-sm font-bold text-gray-700 mb-2">Subjek
                                    Pesan</label>
                                <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                                    placeholder="Misal: Tanya Paket Wisata Keluarga"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition outline-none @error('subject') border-red-500 bg-red-50 @enderror">
                                @error('subject')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Pesan --}}
                            <div>
                                <label for="message" class="block text-sm font-bold text-gray-700 mb-2">Isi Pesan</label>
                                <textarea name="message" id="message" rows="5" placeholder="Tuliskan pertanyaan atau kebutuhan Anda di sini..."
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition outline-none @error('message') border-red-500 bg-red-50 @enderror">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Tombol Submit --}}
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-8 py-4 bg-primary-600 hover:bg-primary-700 text-white font-bold rounded-full shadow-lg shadow-primary-500/30 transform hover:-translate-y-1 transition-all duration-300 flex items-center gap-2">
                                    <span>Kirim Pesan</span>
                                    <i class="icon-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
