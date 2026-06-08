@extends('layouts.app')

@section('title', $trip->title . ' - VisitBatu')

@section('content')
    {{-- 1. HERO SECTION (Konsisten dengan trips_page) --}}
    <div class="relative bg-primary-900 dark:bg-night-950 pt-32 pb-32 overflow-hidden transition-colors duration-300">
        {{-- Background Blobs --}}
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-64 h-64 bg-accent-500 opacity-10 rounded-full blur-3xl"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col items-center text-center">
                {{-- Breadcrumb Sederhana --}}
                <div class="flex items-center gap-2 text-primary-100 text-sm mb-6 font-medium tracking-wide">
                    <a href="/" class="hover:text-white transition">Home</a>
                    <span class="opacity-50">/</span>
                    <a href="{{ route('trips-page.index') }}" class="hover:text-white transition">Destinasi</a>
                    <span class="opacity-50">/</span>
                    <span class="text-accent-400">{{ $trip->title }}</span>
                </div>

                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                    {{ $trip->title }}
                </h1>

                <div class="flex items-center gap-4 text-white/80 text-sm md:text-base">
                    <span class="flex items-center gap-2">
                        <i class="icon-map-marker text-accent-400"></i> {{ $trip->location }}
                    </span>
                    <span class="w-1.5 h-1.5 rounded-full bg-accent-400"></span>
                    <span class="flex items-center gap-2">
                        <i class="icon-folder text-accent-400"></i> {{ $trip->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- 2. MAIN CONTENT (Grid Layout) --}}
    <div class="bg-gray-50 dark:bg-night-900 min-h-screen relative -mt-16 pb-20 z-20 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                {{-- KOLOM KIRI: Konten Utama (Gambar & Deskripsi) --}}
                <div class="lg:col-span-2 space-y-8">

                    {{-- Main Image --}}
                    <div class="bg-white dark:bg-night-800 p-2 mt-5 rounded-4xl shadow-xl transition-colors duration-300">
                        <div class="relative aspect-video rounded-3xl overflow-hidden">
                            <img src="{{ Str::startsWith($trip->thumbnail, 'http') ? $trip->thumbnail : asset('storage/' . $trip->thumbnail) }}"
                                alt="{{ $trip->title }}"
                                class="w-full h-full object-cover hover:scale-105 transition duration-700">
                        </div>
                    </div>

                    {{-- Deskripsi Text --}}
                    <div class="bg-white dark:bg-night-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-night-700/50 transition-colors duration-300">
                        <h3 class="font-serif text-2xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-3">
                            <span class="w-8 h-1 bg-primary-600 rounded-full block"></span>
                            Tentang Destinasi
                        </h3>

                        <div class="prose prose-lg text-gray-600 dark:text-white/70 leading-relaxed font-sans max-w-none">
                            {!! nl2br(e($trip->description)) !!}
                        </div>
                    </div>

                    {{-- 3. REVIEW SECTION --}}
                    <div class="bg-white dark:bg-night-800 rounded-3xl p-8 shadow-sm border border-gray-100 dark:border-night-700/50 transition-colors duration-300">
                        <h3 class="font-serif text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                            <span class="w-8 h-1 bg-accent-500 rounded-full block"></span>
                            Ulasan Pengunjung
                        </h3>

                        {{-- Rating Stats --}}
                        <div class="flex items-center gap-6 mb-10 pb-10 border-b border-gray-100 dark:border-night-700/50">
                            <div class="text-center">
                                <div class="text-5xl font-bold text-gray-900 dark:text-white mb-1">
                                    {{ number_format($trip->average_rating, 1) }}</div>
                                <div class="flex text-accent-500 mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-5 w-5 {{ $i <= round($trip->average_rating) ? 'fill-current' : 'text-gray-200 dark:text-night-600' }}"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <div class="text-sm text-gray-400 dark:text-white/50 font-medium">{{ $trip->reviews->count() }} Ulasan</div>
                            </div>
                        </div>

                        {{-- Review Form (Hanya untuk yang sudah login) --}}
                        @auth
                            <div class="mb-12 bg-gray-50 dark:bg-night-900/50 rounded-2xl p-6 border border-gray-100 dark:border-night-700/50" x-data="{ rating: 0, isLoading: false }">
                                <h4 class="font-bold text-gray-900 dark:text-white mb-4">Berikan Ulasan Anda</h4>
                                <form action="{{ route('reviews.store', $trip->slug) }}" method="POST"
                                    @submit="isLoading = true">
                                    @csrf
                                    <input type="hidden" name="rating" :value="rating">

                                    <div class="flex items-center gap-2 mb-4">
                                        <span class="text-sm text-gray-600 dark:text-white/70 mr-2">Rating:</span>
                                        <template x-for="i in 5">
                                            <button type="button" @click="rating = i"
                                                class="focus:outline-none transition transform hover:scale-110">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8"
                                                    :class="i <= rating ? 'text-accent-500 fill-current' : 'text-gray-300 dark:text-night-600'"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            </button>
                                        </template>
                                    </div>

                                    <div class="mb-4">
                                        <textarea name="comment" rows="3" required
                                            class="w-full bg-white dark:bg-night-800 border border-gray-200 dark:border-night-700 rounded-xl p-4 focus:ring-2 focus:ring-primary-500 outline-none text-gray-700 dark:text-white transition"
                                            placeholder="Bagaimana pengalaman Anda berkunjung ke sini?"></textarea>
                                    </div>

                                    <button type="submit" :disabled="isLoading || rating === 0"
                                        class="px-8 py-3 bg-primary-900 text-white font-bold rounded-full hover:bg-primary-800 transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span x-show="!isLoading">Kirim Ulasan</span>
                                        <span x-show="isLoading">Mengirim...</span>
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-12 bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-6 border border-blue-100 dark:border-blue-800/50 text-center">
                                <p class="text-blue-700 dark:text-blue-300 mb-4">Silakan login untuk memberikan ulasan pada destinasi ini.</p>
                                <a href="{{ route('login') }}"
                                    class="inline-block px-6 py-2 bg-blue-600 text-white font-bold rounded-full hover:bg-blue-700 transition">Login
                                    Sekarang</a>
                            </div>
                        @endauth

                        {{-- Review List --}}
                        <div class="space-y-8">
                            @forelse($trip->reviews()->with('user')->latest()->get() as $review)
                                <div class="flex gap-4">
                                    <div class="shrink-0">
                                        <img src="{{ $review->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($review->user->name) }}"
                                            class="w-12 h-12 rounded-full object-cover border-2 border-primary-50"
                                            alt="{{ $review->user->name }}">
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-1">
                                            <h5 class="font-bold text-gray-900 dark:text-green-50">{{ $review->user->name }}</h5>
                                            <span
                                                class="text-xs text-gray-400 font-medium">{{ $review->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div class="flex text-accent-500 mb-2">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 {{ $i <= $review->rating ? 'fill-current' : 'text-gray-200 dark:text-night-600' }}"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                                </svg>
                                            @endfor
                                        </div>
                                        <p class="text-gray-600 dark:text-green-300 leading-relaxed">{{ $review->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-10">
                                    <div class="text-gray-300 mb-4 text-6xl italic leading-none">"</div>
                                    <p class="text-gray-400 italic">Belum ada ulasan untuk destinasi ini. Jadilah yang
                                        pertama memberikan ulasan!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                {{-- KOLOM KANAN: Sidebar Sticky (Info & Booking) --}}
                <div class="lg:col-span-1">
                    <div class="sticky top-28 space-y-6">

                        {{-- Card Informasi Harga --}}
                        <div
                            class="bg-white dark:bg-night-800 rounded-3xl p-8 mt-5 shadow-lg dark:shadow-night-950/50 border border-gray-100 dark:border-night-700/50 relative overflow-hidden group transition-colors duration-300">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-primary-50 dark:bg-primary-900/30 rounded-bl-full -mr-4 -mt-4 transition group-hover:bg-primary-100 dark:group-hover:bg-primary-900/50">
                            </div>

                            <p class="text-sm text-gray-500 dark:text-white/60 font-bold uppercase tracking-wider mb-2 relative z-10">Harga Tiket Masuk</p>
                            <div class="flex items-baseline gap-1 mb-6 relative z-10">
                                <span class="text-sm text-gray-400 dark:text-white/50 font-bold">IDR</span>
                                <span
                                    class="text-4xl font-bold text-primary-700 dark:text-primary-400">{{ number_format($trip->price, 0, ',', '.') }}</span>
                            </div>

                            <hr class="border-dashed border-gray-200 dark:border-night-700 mb-6">

                            <div class="space-y-4 mb-8">
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center text-primary-600 dark:text-primary-400 shrink-0">
                                        <i class="fa-regular fa-clock"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 dark:text-white/50 font-bold uppercase">Jam Buka / Durasi</p>
                                        <p class="text-gray-800 dark:text-white font-medium">{{ $trip->duration }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-10 h-10 rounded-full bg-primary-50 dark:bg-primary-900/50 flex items-center justify-center text-primary-600 dark:text-primary-400 shrink-0">
                                        <i class="fa-regular fa-map"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-400 dark:text-white/50 font-bold uppercase">Lokasi</p>
                                        <p class="text-gray-800 dark:text-white font-medium">{{ $trip->location }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol Inquiry WhatsApp --}}
                            @if($trip->whatsapp_number)
                            <a href="https://wa.me/{{ $trip->whatsapp_number }}?text={{ urlencode('Halo, saya ingin bertanya mengenai destinasi ' . $trip->title . ' di VisitBatu.') }}"
                                target="_blank"
                                class="flex items-center justify-center gap-3 w-full py-4 bg-[#25D366] text-white font-bold text-center rounded-xl hover:bg-[#128C7E] transition shadow-lg transform hover:-translate-y-1">
                                <i class="fab fa-whatsapp text-xl"></i>
                                Tanya via WhatsApp
                            </a>
                            <p class="text-[10px] text-center text-gray-400 mt-4 uppercase tracking-widest font-bold">Respon Cepat via WhatsApp</p>
                            @else
                            <a href="{{ route('contact_page') }}"
                                class="block w-full py-4 bg-gray-900 dark:bg-transparent text-white dark:text-white border border-transparent dark:border-white/60 font-bold text-center rounded-xl hover:bg-primary-600 dark:hover:bg-white dark:hover:text-gray-900 transition shadow-lg transform hover:-translate-y-1">
                                Hubungi Kami
                            </a>
                            <p class="text-[10px] text-center text-gray-400 mt-4 uppercase tracking-widest font-bold">Informasi Lebih Lanjut</p>
                            @endif
                        </div>

                        {{-- Card Bantuan (Optional) --}}
                        <div class="bg-primary-900 dark:bg-night-950 rounded-3xl p-8 text-center text-white relative overflow-hidden transition-colors duration-300">
                            <div class="absolute inset-0 bg-pattern opacity-10"></div>
                            <h4 class="font-serif text-xl font-bold mb-2 relative z-10">Butuh Bantuan?</h4>
                            <p class="text-primary-100 text-sm mb-6 relative z-10">Hubungi tim kami untuk info lebih
                                lanjut.
                            </p>
                            <a href="{{ route('contact_page') }}"
                                class="inline-block px-6 py-2 bg-white text-primary-900 font-bold rounded-full text-sm hover:bg-accent-400 hover:text-white transition relative z-10">
                                Hubungi Kami
                            </a>
                        </div>

                        {{-- Map Card --}}
                        @if ($trip->latitude && $trip->longitude)
                            <div class="bg-white dark:bg-night-800 rounded-3xl p-4 shadow-lg dark:shadow-night-950/50 border border-gray-100 dark:border-night-700/50 overflow-hidden transition-colors duration-300">
                                <h4 class="font-serif text-lg font-bold text-gray-900 dark:text-white mb-4 px-2">Lokasi di Peta</h4>
                                <div id="map" class="rounded-2xl overflow-hidden aspect-square z-10 antialiased">
                                </div>
                                <div class="mt-4 px-2 flex justify-between items-center">
                                    <span class="text-[10px] text-gray-400 dark:text-white/50 font-bold uppercase tracking-widest">Interactive
                                        Map</span>
                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $trip->latitude }},{{ $trip->longitude }}"
                                        target="_blank"
                                        class="text-xs text-primary-600 font-bold hover:text-primary-700 transition flex items-center gap-1">
                                        Buka di Google Maps <i class="icon-external-link"></i>
                                    </a>
                                </div>
                            </div>

                            @push('styles')
                                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
                                    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
                                <style>
                                    .leaflet-container {
                                        font-family: inherit;
                                    }
                                </style>
                            @endpush

                            @push('scripts')
                                <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
                                    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const lat = {{ $trip->latitude }};
                                        const lng = {{ $trip->longitude }};
                                        const map = L.map('map', {
                                            scrollWheelZoom: false
                                        }).setView([lat, lng], 15);

                                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                                        }).addTo(map);

                                        L.marker([lat, lng]).addTo(map)
                                            .bindPopup('<b class="font-serif">{{ $trip->title }}</b><br>{{ $trip->location }}')
                                            .openPopup();

                                        // Allow scroll zoom on click
                                        map.on('click', function() {
                                            if (map.scrollWheelZoom.enabled()) {
                                                map.scrollWheelZoom.disable();
                                            } else {
                                                map.scrollWheelZoom.enable();
                                            }
                                        });
                                    });
                                </script>
                            @endpush
                        @elseif ($trip->map_iframe)
                            <div class="bg-white dark:bg-night-800 rounded-3xl p-4 shadow-lg dark:shadow-night-950/50 border border-gray-100 dark:border-night-700/50 overflow-hidden transition-colors duration-300">
                                <h4 class="font-serif text-lg font-bold text-gray-900 dark:text-white mb-4 px-2">Lokasi di Peta</h4>
                                <div class="rounded-2xl overflow-hidden aspect-square">
                                    {!! $trip->map_iframe !!}
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
