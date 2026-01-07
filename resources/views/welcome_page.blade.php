@extends('layouts.app')

@section('content')
    <header class="relative h-[100vh] min-h-[600px] flex items-center justify-center bg-fixed bg-cover bg-center"
        style="background-image: url('/images/0100212000m50kq2i5872.jpg');">

        <div class="absolute inset-0 bg-gradient-to-b from-black/70 via-black/40 to-black/80"></div>

        <div class="relative z-10 text-center px-4 max-w-5xl mx-auto -mt-20">
            <div class="inline-block mb-4 px-4 py-1 rounded-full border border-white/30 bg-white/10 backdrop-blur-md">
                <span class="text-accent-400 font-bold tracking-[0.2em] text-xs uppercase">The Highland Paradise</span>
            </div>

            <h1 class="font-serif text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 leading-tight drop-shadow-2xl">
                Experience the <br> <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-accent-400 to-accent-200">Magic of Batu</span>
            </h1>

            <p class="text-gray-200 text-lg md:text-xl font-light max-w-2xl mx-auto leading-relaxed">
                Jelajahi pesona kota pegunungan yang sejuk. Dari wisata alam yang menenangkan hingga taman hiburan kelas
                dunia.
            </p>
        </div>

        {{-- <div class="absolute bottom-0 translate-y-1/2 w-full px-4 z-20">
            <div
                class="max-w-4xl mx-auto bg-white rounded-3xl shadow-float p-4 md:p-6 flex flex-col md:flex-row gap-4 items-center border border-gray-100">
                <div class="flex-1 w-full relative">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Destinasi</label>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-primary-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <input type="text" placeholder="Mau kemana hari ini?"
                            class="w-full outline-none text-gray-800 font-serif font-bold text-lg placeholder-gray-300">
                    </div>
                </div>
                <div class="hidden md:block w-px h-12 bg-gray-200"></div>
                <div class="flex-1 w-full relative">
                    <label class="block text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tanggal</label>
                    <input type="date" class="w-full outline-none text-gray-800 font-bold text-lg bg-transparent">
                </div>
                <button
                    class="w-full md:w-auto bg-primary-800 hover:bg-primary-900 text-white px-8 py-4 rounded-xl font-bold text-lg transition shadow-lg shadow-primary-800/30 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Cari</span>
                </button>
            </div>
        </div> --}}
    </header>

    <section class="pt-32 pb-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="relative">
                    <div
                        class="absolute -top-4 -left-4 w-24 h-24 bg-accent-100 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob">
                    </div>
                    <div class="relative grid grid-cols-2 gap-4">
                        <img src="/images/0M70r12000fppl8mk8D3E_R5.png_.webp"
                            class="rounded-2xl shadow-lg w-full h-64 object-cover mt-8 transform hover:-translate-y-2 transition duration-500">
                        <img src="/images/0M70g12000fpqctw23875_R5.png_.webp"
                            class="rounded-2xl shadow-lg w-full h-64 object-cover transform hover:-translate-y-2 transition duration-500">
                    </div>
                    <div
                        class="absolute -bottom-6 -right-6 bg-white p-6 rounded-xl shadow-xl border border-gray-50 max-w-xs">
                        <div class="flex items-center gap-4">
                            <div class="bg-primary-100 p-3 rounded-full text-primary-700">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-3xl font-bold text-gray-900">150+</p>
                                <p class="text-xs text-gray-500 uppercase tracking-wide">Destinasi Wisata</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <span class="text-primary-700 font-bold tracking-widest uppercase text-sm mb-2 block">Tentang
                        VisitBatu</span>
                    <h2 class="font-serif text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                        Gerbang Utama Menuju <br> <span class="italic text-primary-700">Kota Apel</span>
                    </h2>
                    <p class="text-gray-600 text-lg leading-relaxed mb-6">
                        VisitBatu adalah platform kurasi wisata premium yang didedikasikan untuk membantu Anda menemukan
                        keindahan tersembunyi di Kota Batu.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed mb-8">
                        Kami menghubungkan wisatawan dengan destinasi lokal terbaik, mulai dari agrowisata petik apel, air
                        terjun alami, hingga taman rekreasi modern berstandar internasional.
                    </p>

                    <ul class="space-y-4 mb-8">
                        <li class="flex items-center gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent-500 flex items-center justify-center text-white text-xs">✓</span>
                            <span class="font-medium text-gray-700">Informasi Wisata Terupdate</span>
                        </li>
                        <li class="flex items-center gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent-500 flex items-center justify-center text-white text-xs">✓</span>
                            <span class="font-medium text-gray-700">Ulasan Jujur dari Komunitas</span>
                        </li>
                    </ul>

                    <a href="{{ url('/trips') }}"
                        class="inline-flex items-center gap-2 text-primary-800 font-bold border-b-2 border-primary-800 pb-1 hover:text-accent-600 hover:border-accent-600 transition">
                        Pelajari Lebih Lanjut <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-accent-500 font-bold tracking-widest uppercase text-sm">Destinations</span>
                <h2 class="font-serif text-4xl font-bold text-gray-900 mt-2">Top Pick Destinations</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($trips as $trip)
                    <div
                        class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 cursor-pointer">
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ Str::startsWith($trip->thumbnail, 'http') ? $trip->thumbnail : asset('storage/' . $trip->thumbnail) }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700"
                                alt="{{ $trip->title }}">
                        </div>
                        <div class="p-8">
                            <h3 class="font-serif text-2xl font-bold text-gray-900 mb-2">{{ $trip->title }}</h3>
                            <p class="text-gray-500 mb-6 line-clamp-2 text-sm">{{ $trip->description }}</p>
                            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                                <span class="text-xl font-bold text-primary-700">Rp {{ number_format($trip->price) }}</span>
                                <a href="{{ route('trips.show', $trip->id) }}"
                                    class="w-10 h-10 rounded-full border flex items-center justify-center hover:bg-primary-700 hover:text-white transition">
                                    &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="col-span-full text-center text-gray-500">Belum ada destinasi wisata.</p>
                @endforelse
            </div>

            <div class="mt-16 text-center">
                <a href="{{ url('/trips') }}"
                    class="inline-block px-8 py-3 rounded-full border-2 border-gray-900 text-gray-900 font-bold hover:bg-gray-900 hover:text-white transition">Lihat
                    Semua Destinasi</a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <div>
                    <h2 class="font-serif text-4xl font-bold text-gray-900">Traveler's Stories</h2>
                    <p class="text-gray-500 mt-2">Cerita pengalaman langsung dari pengunjung.</p>
                </div>
                <a href="{{ url('/blog') }}" class="text-primary-700 font-bold hover:text-accent-500 transition">Read
                    Journal &rarr;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                @forelse($posts as $post)
                    <article class="flex gap-6 group cursor-pointer">
                        <div class="w-1/3 h-40 rounded-2xl overflow-hidden">
                            <img src="{{ Str::startsWith($post->image, 'http') ? $post->image : asset('storage/' . $post->image) }}"
                                class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span
                                    class="text-[10px] font-bold bg-accent-100 text-accent-700 px-2 py-0.5 rounded uppercase">Blog</span>
                                <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            <h3
                                class="font-serif text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-primary-700 transition">
                                <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2">
                                {{ Str::limit(strip_tags($post->content), 100) }}</p>
                        </div>
                    </article>
                @empty
                    <p class="text-gray-500">Belum ada cerita terbaru.</p>
                @endforelse
            </div>
        </div>
    </section>
@endsection
