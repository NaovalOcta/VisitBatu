<nav x-data="{ scrolled: false, mobileOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 50)"
    :class="scrolled ? 'glass-effect py-3 shadow-sm text-gray-800' : 'bg-transparent py-6 text-white'"
    class="fixed w-full z-50 transition-all duration-300 top-0 left-0">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div :class="scrolled ? 'bg-primary-800 text-white' : 'bg-white text-primary-900'"
                    class="w-10 h-10 flex items-center justify-center rounded-lg shadow-lg transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <div>
                    <h1 class="font-serif font-bold text-2xl leading-none tracking-tight">Visit<span
                            class="text-accent-500">Batu</span></h1>
                    <p class="text-[10px] uppercase tracking-[0.2em] font-medium opacity-80">Nature & Heritage</p>
                </div>
            </a>

            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ url('/') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Home</a>
                <a href="{{ url('/trips-page') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Destinations</a>
                <a href="{{ url('/blog-page') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Stories</a>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center gap-2 focus:outline-none">
                            <span class="text-right text-sm leading-tight">
                                <span class="block font-bold">{{ Auth::user()->name }}</span>
                            </span>
                            <div
                                class="h-9 w-9 rounded-full bg-accent-500 flex items-center justify-center text-white font-serif font-bold shadow-md">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>
                        <div x-show="open" x-transition
                            class="absolute right-0 mt-3 w-48 bg-white text-gray-800 rounded-xl shadow-xl border border-gray-100 py-2 overflow-hidden">

                            {{-- LOGIKA PENGECEKAN ROLE --}}
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50">
                                    Dashboard
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="font-bold text-sm hover:underline decoration-accent-500 decoration-2 underline-offset-4">Log
                        In</a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 bg-accent-500 hover:bg-accent-600 text-white rounded-full text-sm font-bold shadow-lg shadow-accent-500/30 transition transform hover:-translate-y-0.5">Sign
                        Up</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
