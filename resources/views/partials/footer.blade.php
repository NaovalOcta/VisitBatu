<footer class="bg-gray-900 dark:bg-night-950 text-white pt-20 pb-10 border-t border-gray-800 dark:border-night-800 relative overflow-hidden font-sans transition-colors duration-300">

    <div class="absolute top-0 left-0 -ml-10 -mt-10 w-40 h-40 bg-primary-900 rounded-full blur-3xl opacity-20"></div>
    <div class="absolute bottom-0 right-0 -mr-10 -mb-10 w-60 h-60 bg-accent-600 rounded-full blur-3xl opacity-10"></div>

    <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 mb-16 border-b border-gray-800 dark:border-night-800 pb-12">
            <div class="lg:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-3 mb-6">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-primary-500 to-primary-700 rounded-lg flex items-center justify-center text-white shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /> 
                        </svg>
                    </div>
                    <span class="font-serif text-2xl font-bold tracking-wide">Visit<span
                            class="text-accent-500">Batu</span></span>
                </a>
                <p class="text-gray-400 leading-relaxed mb-6 pr-4">
                    Platform panduan wisata terpercaya untuk menjelajahi keindahan Kota Batu. Temukan destinasi alam,
                    kuliner, dan hiburan terbaik dalam satu genggaman.
                </p>
                <div class="flex space-x-4">
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-accent-500 hover:text-white transition-all duration-300">
                        <img src="https://cdn.simpleicons.org/instagram/white"
                            class="w-4 h-4 opacity-70 hover:opacity-100">
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-accent-500 hover:text-white transition-all duration-300">
                        <img src="https://cdn.simpleicons.org/facebook/white"
                            class="w-4 h-4 opacity-70 hover:opacity-100">
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-accent-500 hover:text-white transition-all duration-300">
                        <img src="https://cdn.simpleicons.org/x/white" class="w-4 h-4 opacity-70 hover:opacity-100">
                    </a>
                    <a href="#"
                        class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-gray-400 hover:bg-accent-500 hover:text-white transition-all duration-300">
                        <img src="https://cdn.simpleicons.org/youtube/white"
                            class="w-4 h-4 opacity-70 hover:opacity-100">
                    </a>
                </div>
            </div>

            <div class="lg:col-span-3 bg-gray-800/50 dark:bg-night-900/50 rounded-2xl p-8 border border-gray-700/50 dark:border-night-800/50">
                <h3 class="text-xl font-bold font-serif mb-2">Bergabung dengan Newsletter Kami</h3>
                <p class="text-gray-400 dark:text-white/60 text-sm mb-6">Dapatkan info promo tiket dan rekomendasi wisata tersembunyi
                     setiap minggunya.</p>
                <form class="flex flex-col sm:flex-row gap-3">
                    <input type="email" placeholder="Masukkan alamat email Anda"
                        class="flex-1 px-5 py-3 rounded-xl bg-gray-900 border border-gray-700 text-white focus:outline-none focus:border-accent-500 transition">
                    <button
                        class="px-8 py-3 bg-accent-500 hover:bg-accent-600 text-white font-bold rounded-xl transition shadow-lg shadow-accent-500/20">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 lg:gap-12 mb-16">
            <div>
                <h4
                    class="text-white font-bold uppercase tracking-wider text-xs mb-6 border-b border-accent-500 inline-block pb-1">
                    {{ __('Jelajahi') }}</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="{{ url('/') }}"
                            class="hover:text-accent-400 transition flex items-center gap-2">{{ __('Beranda') }}</a></li>
                    <li><a href="{{ url('/trips') }}"
                            class="hover:text-accent-400 transition flex items-center gap-2">{{ __('Destinasi Wisata') }}</a></li>
                    <li><a href="{{ url('/blog') }}"
                            class="hover:text-accent-400 transition flex items-center gap-2">{{ __('Blog') }}</a></li>
                </ul>
            </div>

            <div>
                <h4
                    class="text-white font-bold uppercase tracking-wider text-xs mb-6 border-b border-accent-500 inline-block pb-1">
                    Kategori</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-accent-400 transition">Wisata Alam</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Theme Park</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Kuliner Legendaris</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Penginapan & Hotel</a></li>
                </ul>
            </div>

            <div>
                <h4
                    class="text-white font-bold uppercase tracking-wider text-xs mb-6 border-b border-accent-500 inline-block pb-1">
                    Dukungan</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-accent-400 transition">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Kontak</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:text-accent-400 transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <div>
                <h4
                    class="text-white font-bold uppercase tracking-wider text-xs mb-6 border-b border-accent-500 inline-block pb-1">
                    Hubungi Kami</h4>
                <ul class="space-y-4 text-sm text-gray-400">
                    <li class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-accent-500 mt-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                        <span>Jl. Sultan Agung No. 12, Kota Batu, Jawa Timur 65314</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>hello@visitbatu.id</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-accent-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+62 812 3456 7890</span>
                    </li>
                </ul>
            </div>
        </div>

        <div
            class="border-t border-gray-800 dark:border-night-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500 dark:text-white/50">
            <p>&copy; {{ date('Y') }} VisitBatu Portal. Dibuat dengan <span class="text-red-500">❤</span> di Kota
                Batu.</p>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="hover:text-white transition">Privacy</a>
                <a href="#" class="hover:text-white transition">Cookies</a>
                <a href="#" class="hover:text-white transition">Terms</a>
            </div>
        </div>
    </div>
</footer>
