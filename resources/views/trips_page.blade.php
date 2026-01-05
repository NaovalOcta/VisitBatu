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
        </div>
    </div>

    <div class="bg-gray-50 min-h-screen py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-10">

                <form action="{{ route('trips.index') }}" method="GET" id="filterForm" class="w-full lg:w-1/4">

                    <input type="hidden" name="sort" id="hiddenSortInput" value="{{ request('sort') }}">

                    <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 sticky top-28">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-serif text-xl font-bold text-gray-900">Filter</h3>
                            <a href="{{ route('trips.index') }}"
                                class="text-xs text-primary-700 font-bold hover:underline">Reset</a>
                        </div>

                        <div class="mb-8">
                            <div class="relative">
                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari destinasi..."
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
                                    @foreach ($categories as $cat)
                                        <label class="flex items-center gap-3 cursor-pointer group">
                                            <div class="relative flex items-center">
                                                {{-- Value sekarang menggunakan ID, bukan string nama --}}
                                                <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                                                    {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }}
                                                    class="peer h-5 w-5 cursor-pointer appearance-none rounded-md border border-gray-300 transition-all checked:border-primary-600 checked:bg-primary-600 hover:border-primary-500">
                                                <svg class="pointer-events-none absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="4" stroke-linecap="round"
                                                    stroke-linejoin="round" width="12" height="12">
                                                    <polyline points="20 6 9 17 4 12"></polyline>
                                                </svg>
                                            </div>
                                            <span
                                                class="text-gray-600 group-hover:text-primary-700 transition">{{ $cat->name }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="pt-6 border-t border-gray-100">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3 block">Maksimal
                                    Harga</label>
                                <input type="range" name="max_price" min="0" max="500000" step="10000"
                                    value="{{ request('max_price', 500000) }}"
                                    oninput="document.getElementById('priceLabel').innerText = 'IDR ' + new Intl.NumberFormat('id-ID').format(this.value)"
                                    class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary-600">
                                <div class="flex justify-between text-xs text-gray-500 mt-2 font-medium">
                                    <span>IDR 0</span>
                                    <span id="priceLabel">IDR {{ number_format(request('max_price', 500000)) }}</span>
                                </div>
                            </div>

                            <div class="pt-4">
                                <button type="submit"
                                    class="w-full py-3 bg-gray-900 text-white rounded-xl font-bold text-sm hover:bg-primary-700 transition shadow-lg">
                                    Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="w-full lg:w-3/4">
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-500 text-sm">Menampilkan <span
                                class="font-bold text-gray-900">{{ $trips->total() }}</span> destinasi</p>

                        <select
                            onchange="document.getElementById('hiddenSortInput').value = this.value; document.getElementById('filterForm').submit();"
                            class="bg-transparent border-none text-sm font-bold text-gray-700 focus:ring-0 cursor-pointer hover:text-primary-700">
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
                                <div class="mb-4 text-gray-200">
                                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900">Tidak ada destinasi ditemukan</h3>
                                <p class="text-gray-500">Coba ubah filter atau kata kunci pencarian Anda.</p>
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
