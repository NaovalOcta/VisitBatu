@extends('layouts.app')

@section('title', 'Travel Journal - VisitBatu')

@section('content')
    <div class="bg-primary-900 pt-32 pb-24 text-center text-white px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
        <span class="text-accent-400 font-bold tracking-widest uppercase text-sm mb-4 inline-block relative z-10">The
            Journal</span>
        <h1 class="font-serif text-4xl md:text-6xl font-bold mb-4 relative z-10">Stories from Batu</h1>
        <p class="text-primary-100 text-lg max-w-2xl mx-auto font-light relative z-10">
            Kumpulan cerita, tips perjalanan, dan inspirasi liburan dari para traveler yang telah menjelajahi sudut-sudut
            Kota Batu.
        </p>
    </div>

    <div class="bg-white min-h-screen pb-20 -mt-10 relative z-20 rounded-t-[3rem]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-20 group cursor-pointer h-[500px]">
                <img src="https://images.unsplash.com/photo-1571772996211-2f02c9727629?q=80&w=2070&auto=format&fit=crop"
                    class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105"
                    alt="Featured Post">
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full md:max-w-3xl">
                    <div class="flex items-center gap-3 mb-4">
                        <span
                            class="bg-accent-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Editor's
                            Pick</span>
                        <span class="text-gray-300 text-sm font-medium">10 Min Read</span>
                    </div>
                    <h2
                        class="font-serif text-3xl md:text-5xl font-bold text-white mb-4 leading-tight group-hover:text-accent-400 transition">
                        Hidden Gem: Menikmati Kopi di Tengah Hutan Pinus Kota Batu
                    </h2>
                    <p class="text-gray-300 text-lg line-clamp-2 mb-6 font-light">
                        Rasakan sensasi menyeruput kopi hangat dengan suhu 18 derajat celcius, dikelilingi pohon pinus yang
                        menjulang tinggi di area Coban Talun.
                    </p>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-white/20 backdrop-blur border border-white/30 flex items-center justify-center text-white font-bold font-serif">
                            A
                        </div>
                        <div class="text-sm">
                            <p class="text-white font-bold">Admin VisitBatu</p>
                            <p class="text-gray-400">20 Desember 2025</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 pb-12 border-b border-gray-100">
                <div class="flex gap-2 overflow-x-auto pb-2 md:pb-0 w-full md:w-auto no-scrollbar">
                    <button
                        class="px-6 py-2 rounded-full bg-primary-900 text-white font-bold text-sm whitespace-nowrap">Semua</button>
                    <button
                        class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200 transition whitespace-nowrap">Kuliner</button>
                    <button
                        class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200 transition whitespace-nowrap">Tips
                        Wisata</button>
                    <button
                        class="px-6 py-2 rounded-full bg-gray-100 text-gray-600 font-medium text-sm hover:bg-gray-200 transition whitespace-nowrap">Itinerary</button>
                </div>

                <div class="relative w-full md:w-72">
                    <input type="text" placeholder="Cari artikel..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:border-primary-500 focus:ring-1 focus:ring-primary-500">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-2.5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>

            @if ($featuredPost)
                <div class="relative rounded-3xl overflow-hidden shadow-2xl mb-20 group cursor-pointer h-[500px]">
                    <img src="{{ Str::startsWith($featuredPost->image, 'http') ? $featuredPost->image : asset('storage/' . $featuredPost->image) }}"
                        class="absolute inset-0 w-full h-full object-cover transition duration-1000 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                    <div class="absolute bottom-0 left-0 p-8 md:p-12 w-full md:max-w-3xl">
                        <h2 class="font-serif text-3xl md:text-5xl font-bold text-white mb-4">
                            <a href="{{ route('blog.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                        </h2>
                        <div class="flex items-center gap-4 text-white">
                            <span class="font-bold">{{ $featuredPost->user->name ?? 'Admin' }}</span>
                            <span>•</span>
                            <span>{{ $featuredPost->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-12">
                @foreach ($posts as $post)
                    {{-- Skip jika ini adalah featured post agar tidak muncul 2x --}}
                    @continue($featuredPost && $post->id === $featuredPost->id)

                    <article class="flex flex-col group h-full">
                        <div class="rounded-2xl overflow-hidden h-64 mb-6 shadow-md relative">
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                                class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                        </div>
                        <div class="flex-1 flex flex-col">
                            <div
                                class="flex items-center gap-2 text-xs text-gray-500 mb-3 uppercase tracking-wide font-bold">
                                <span>{{ $post->created_at->format('M d, Y') }}</span>
                                <span class="text-accent-500">&bull;</span>
                                <span>{{ $post->user->name ?? 'User' }}</span>
                            </div>
                            <h3
                                class="font-serif text-2xl font-bold text-gray-900 mb-3 leading-snug group-hover:text-primary-700 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-gray-600 line-clamp-3 mb-4 font-light text-sm">
                                {{ Str::limit(strip_tags($post->content), 120) }}
                            </p>
                            <a href="{{ route('blog.show', $post->slug) }}"
                                class="mt-auto inline-flex items-center gap-1 text-primary-800 font-bold text-sm hover:text-accent-600 transition">
                                Baca Selengkapnya &rarr;
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-20 text-center">
                {{ $posts->links() }}
            </div>

            <div class="mt-20 text-center">
                <button
                    class="px-8 py-3 bg-white border-2 border-primary-900 text-primary-900 font-bold rounded-full hover:bg-primary-900 hover:text-white transition shadow-lg shadow-gray-200">
                    Muat Lebih Banyak Artikel
                </button>
            </div>
        </div>
    </div>
@endsection
