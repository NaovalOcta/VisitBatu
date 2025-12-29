@extends('layouts.app')

@section('title', 'Explore Destinations - VisitBatu')

@section('content')
    <div class="bg-primary-900 pt-32 pb-20 text-center text-white px-4">
        <h1 class="font-serif text-5xl md:text-6xl font-bold mb-4">Explore Destinations</h1>
        <p class="text-primary-100 text-lg max-w-2xl mx-auto">Temukan berbagai destinasi wisata menarik mulai dari alam,
            edukasi, hingga wahana permainan modern.</p>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex flex-col lg:flex-row gap-10">

            <div class="w-full lg:w-1/4">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 sticky top-28">
                    <h3 class="font-serif text-xl font-bold mb-4 text-gray-900">Filter</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="text-sm font-bold text-gray-600 uppercase tracking-wide">Kategori</label>
                            <div class="mt-2 space-y-2">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                    <span>Alam</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                    <span>Theme Park</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" class="rounded text-primary-600 focus:ring-primary-500">
                                    <span>Edukasi</span>
                                </label>
                            </div>
                        </div>
                        <div class="pt-4 border-t">
                            <label class="text-sm font-bold text-gray-600 uppercase tracking-wide">Harga</label>
                            <input type="range" class="w-full mt-2 accent-primary-600">
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>Rp 0</span>
                                <span>Rp 500rb+</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @forelse($trips ?? [] as $trip)
                        <div
                            class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $trip->image }}" alt="{{ $trip->name }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition duration-700">
                                <div
                                    class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-sm font-bold text-primary-800">
                                    Open
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <h3
                                        class="font-serif text-2xl font-bold text-gray-900 group-hover:text-primary-700 transition">
                                        {{ $trip->name }}</h3>
                                </div>
                                <p class="text-gray-500 mb-6 line-clamp-2 flex-grow">{{ $trip->description }}</p>

                                <div class="pt-4 border-t border-gray-100 flex items-center justify-between mt-auto">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase font-bold">Harga Tiket</p>
                                        <p class="text-xl font-bold text-primary-700">Rp {{ number_format($trip->price) }}
                                        </p>
                                    </div>
                                    <a href="{{ url('/trips/' . $trip->id) }}"
                                        class="bg-gray-900 text-white px-6 py-2 rounded-full font-medium text-sm hover:bg-accent-500 transition">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        @for ($i = 0; $i < 4; $i++)
                            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                                <div class="h-64 bg-gray-200 animate-pulse"></div>
                                <div class="p-6">
                                    <div class="h-6 bg-gray-200 rounded w-3/4 mb-3"></div>
                                    <div class="h-4 bg-gray-100 rounded w-full mb-4"></div>
                                    <div class="flex justify-between items-center mt-4">
                                        <div class="h-8 bg-gray-200 rounded w-1/3"></div>
                                        <div class="h-8 bg-gray-800 rounded w-1/4"></div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
