@extends('layouts.app')

@section('title', 'Explore Destinations - VisitBatu')

@section('content')
    <div class="relative bg-primary-900 pt-32 pb-20 overflow-hidden">
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-accent-500 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 text-center max-w-4xl mx-auto px-4">
            <span class="text-accent-400 font-bold tracking-widest uppercase text-sm mb-4 inline-block">Discover
                Nature</span>
            <h1 class="font-serif text-4xl md:text-6xl font-bold text-white mb-6">Explore Destinations</h1>
            <p class="text-primary-100 text-lg md:text-xl font-light leading-relaxed max-w-2xl mx-auto">
                Temukan berbagai destinasi wisata menarik mulai dari alam yang menenangkan, edukasi, hingga wahana permainan
                modern di Kota Batu.
            </p>
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">

                <aside class="w-full lg:w-1/4">
                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-28">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-serif text-xl font-bold text-gray-900">Filter</h3>
                            <button class="text-xs text-primary-700 font-bold hover:underline">Reset</button>
                        </div>

                        <div class="mb-8">
                            <div class="relative">
                                <input type="text" placeholder="Cari destinasi..."
                                    class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 transition">
                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Kategori</label>
                                <div class="space-y-3">
                                    @foreach (['Wisata Alam', 'Theme Park', 'Edukasi', 'Kuliner', 'Hotel & Resort'] as $cat)
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <div class="relative flex items-center">
                                                <input type="checkbox"
                                                    class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 transition-all checked:border-primary-600 checked:bg-primary-600 hover:border-primary-500">
                                                <svg class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="4" stroke-linecap="round"
                                                    stroke-linejoin="round" width="12" height="12">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-gray-600 group-hover:text-primary-700 transition">{{ $cat }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Kisaran
                                    Harga</label>
                                <input type="range" min="0" max="500000"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary-600">
                                <div class="flex justify-between text-xs text-gray-500 mt-2 font-medium">
                                    <span>IDR 0</span>
                                    <span>IDR 500rb+</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>

                <div class="w-full lg:w-3/4">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-500 text-sm">Menampilkan <span class="font-bold text-gray-900">8</span>
                            destinasi terbaik</p>
                        <select
                            class="bg-transparent border-none text-sm font-bold text-gray-700 focus:ring-0 cursor-pointer hover:text-primary-700">
                            <option>Rekomendasi</option>
                            <option>Harga Terendah</option>
                            <option>Harga Tertinggi</option>
                            <option>Terbaru</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @forelse($trips as $trip)
                            <div
                                class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                                <div class="relative h-64 overflow-hidden">
                                    <img src="{{ Str::startsWith($trip->thumbnail, 'http') ? $trip->thumbnail : asset('storage/' . $trip->thumbnail) }}"
                                        alt="{{ $trip->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="font-serif text-2xl font-bold text-gray-900 mb-2">{{ $trip->title }}</h3>
                                    <p class="text-gray-500 mb-6 line-clamp-2 text-sm flex-grow">{{ $trip->description }}
                                    </p>
                                    <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                        <div>
                                            <p class="text-[10px] text-gray-400 uppercase font-bold tracking-wider">Tiket
                                                Masuk</p>
                                            <p class="text-xl font-bold text-primary-700">Rp
                                                {{ number_format($trip->price) }}</p>
                                        </div>
                                        <a href="{{ route('trips.show', $trip->id) }}"
                                            class="px-6 py-2 bg-gray-900 text-white rounded-full text-sm font-bold hover:bg-accent-500 transition">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <p class="text-gray-500 text-lg">Tidak ada destinasi ditemukan.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-16 flex justify-center">
                        {{ $trips->links() }}
                    </div>

                    <div class="mt-16 flex justify-center">
                        <nav class="flex items-center gap-2">
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:border-primary-600 hover:text-primary-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center rounded-full bg-primary-600 text-white font-bold shadow-lg shadow-primary-600/30">1</a>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:border-primary-600 hover:text-primary-600 transition">2</a>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-600 hover:border-primary-600 hover:text-primary-600 transition">3</a>
                            <span class="text-gray-400">...</span>
                            <a href="#"
                                class="w-10 h-10 flex items-center justify-center rounded-full border border-gray-200 text-gray-500 hover:border-primary-600 hover:text-primary-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
