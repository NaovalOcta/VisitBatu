@extends('layouts.app')

@section('title', 'Explore Destinations - VisitBatu')

@section('content')
    {{-- Full-Viewport Hero — konsisten dengan landing page --}}
    <header class="relative h-[60vh] min-h-[480px] flex items-end justify-center bg-cover bg-center"
        style="background-image: url('/images/0100212000m50lkbd68A5.jpg');">

        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/30 to-black/75"></div>

        <div class="relative z-10 text-center px-4 max-w-4xl mx-auto pb-20">
            <div class="inline-block mb-4 px-4 py-1 rounded-full border border-white/30 bg-white/10 backdrop-blur-md">
                <span class="text-accent-400 font-bold tracking-[0.2em] text-xs uppercase">Discover Nature</span>
            </div>
            <h1 class="font-serif text-5xl md:text-7xl font-bold text-white mb-4 leading-tight drop-shadow-2xl">Explore Destinations</h1>
            <p class="text-gray-200 text-lg font-light max-w-2xl mx-auto leading-relaxed">
                Temukan destinasi wisata terbaik di Kota Batu — dari pegunungan hijau hingga taman hiburan kelas dunia.
            </p>
        </div>
    </header>


    <div class="bg-gray-50 dark:bg-night-900 min-h-screen py-16 -mt-10 relative z-20 rounded-t-[3rem] transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">

                <form action="{{ route('trips-page.index') }}" method="GET" id="filterForm" class="w-full lg:w-1/4">

                    <input type="hidden" name="sort" id="hiddenSortInput" value="{{ request('sort') }}">

                    <div class="bg-white dark:bg-night-800 p-6 rounded-3xl shadow-sm dark:shadow-night-950/50 border border-gray-100 dark:border-night-700/50 sticky top-28 transition-colors duration-300">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-serif text-xl font-bold text-gray-900 dark:text-white">Filter</h3>
                            <a href="{{ route('trips-page.index') }}"
                                class="text-xs text-primary-700 font-bold hover:underline">Reset</a>
                        </div>

                        <div class="mb-8">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari destinasi..."
                                    class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-night-900/50 border border-gray-200 dark:border-night-700 rounded-xl text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500 text-gray-700 dark:text-white placeholder-gray-400 dark:placeholder-white/30 transition">
                                <svg class="w-4 h-4 text-gray-400 dark:text-white/50 absolute left-3 top-3.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label
                                    class="text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider mb-3 block">Kategori</label>
                                <div class="space-y-3">
                                    @foreach ($categories as $cat)
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <div class="relative flex items-center">
                                                {{-- Value sekarang menggunakan ID, bukan string nama --}}
                                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                                    {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }}
                                                    class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 dark:border-night-600 dark:bg-night-900/50 transition-all checked:border-primary-600 checked:bg-primary-600 hover:border-primary-500">
                                                <svg class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="4" stroke-linecap="round"
                                                    stroke-linejoin="round" width="12" height="12">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-gray-600 dark:text-white/70 group-hover:text-primary-700 dark:group-hover:text-primary-400 transition">{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100 dark:border-night-700">
                                <label class="text-xs font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider mb-3 block">Maksimal
                                    Harga</label>
                                <input type="range" name="max_price" min="0" max="500000" step="10000"
                                    value="{{ request('max_price', 500000) }}"
                                    oninput="document.getElementById('priceLabel').innerText = 'IDR ' + new Intl.NumberFormat('id-ID').format(this.value)"
                                    class="w-full h-2 bg-gray-200 dark:bg-night-700 rounded-lg appearance-none cursor-pointer accent-primary-600">
                                <div class="flex justify-between text-xs text-gray-500 dark:text-white/60 mt-2 font-medium">
                                    <span>IDR 0</span>
                                    <span id="priceLabel">IDR {{ number_format(request('max_price', 500000)) }}</span>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full py-3 bg-gray-900 dark:bg-transparent text-white dark:text-white border border-transparent dark:border-white/60 rounded-xl font-bold text-sm hover:bg-primary-700 dark:hover:bg-white dark:hover:text-gray-900 transition shadow-lg">
                                    Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="w-full lg:w-3/4">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-500 dark:text-white/60 text-sm">Menampilkan <span
                                class="font-bold text-gray-900 dark:text-white">{{ $trips->total() }}</span> destinasi</p>

                        <select
                            onchange="document.getElementById('hiddenSortInput').value = this.value; document.getElementById('filterForm').submit();"
                            class="bg-transparent border-none text-sm font-bold text-gray-700 dark:text-white/80 focus:ring-0 cursor-pointer hover:text-primary-700 dark:hover:text-primary-400 dark:bg-night-800">
                            <option value="rekomendasi" {{ request('sort') == 'rekomendasi' ? 'selected' : '' }}>
                                Rekomendasi</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah
                            </option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga
                                Tertinggi</option>
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        @forelse($trips as $trip)
                            <div
                                class="group bg-white dark:bg-night-800 rounded-3xl overflow-hidden shadow-sm dark:shadow-night-950/50 hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-transparent flex flex-col h-full">
                                <div class="relative h-64 overflow-hidden">
                                    <img src="{{ Str::startsWith($trip->thumbnail, 'http') ? $trip->thumbnail : asset('storage/' . $trip->thumbnail) }}"
                                        alt="{{ $trip->title }}"
                                        class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                </div>
                                <div class="p-6 flex flex-col flex-grow">
                                    <h3 class="font-serif text-2xl font-bold text-gray-900 dark:text-white mb-2">{{ $trip->title }}</h3>
                                    <p class="text-gray-500 dark:text-white/60 mb-6 line-clamp-2 text-sm flex-grow">{{ $trip->description }}
                                    </p>
                                    <div class="pt-4 border-t border-gray-100 dark:border-night-700/50 flex items-center justify-between mt-auto">
                                        <div>
                                            <p class="text-[10px] text-gray-400 dark:text-white/50 uppercase font-bold tracking-wider">Tiket
                                                Masuk</p>
                                            <p class="text-xl font-bold text-primary-700 dark:text-primary-400">Rp
                                                {{ number_format($trip->price) }}</p>
                                        </div>
                                        <a href="{{ route('trips-page.show', $trip) }}"
                                            class="px-6 py-2 bg-gray-900 dark:bg-transparent text-white dark:text-accent-400 border border-transparent dark:border-accent-400 rounded-full text-sm font-bold hover:bg-accent-500 dark:hover:bg-accent-400 dark:hover:text-gray-950 transition">
                                            Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full py-12 text-center">
                                <div class="mb-4 text-gray-200 dark:text-night-700">
                                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 dark:text-white">Tidak ada destinasi ditemukan</h3>
                                <p class="text-gray-500 dark:text-white/60">Coba ubah filter atau kata kunci pencarian Anda.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-16 flex justify-center">
                        {{ $trips->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
