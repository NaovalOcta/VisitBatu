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

            {{-- Desktop Navigation --}}
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('welcome_page') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Home</a>
                <a href="{{ route('trips-page.index') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Destinations</a>
                <a href="{{ route('blog-page.index') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">Stories</a>
            </div>

            {{-- Desktop Auth --}}
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

            {{-- Mobile Hamburger Button --}}
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg hover:bg-white/10 transition focus:outline-none">
                <svg x-show="!mobileOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="mobileOpen" x-cloak xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Mobile Navigation Panel --}}
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2" x-cloak class="md:hidden mt-4 pb-4 border-t"
            :class="scrolled ? 'border-gray-200' : 'border-white/20'">

            <div class="flex flex-col space-y-1 pt-4">
                <a href="{{ route('welcome_page') }}"
                    class="px-4 py-3 rounded-xl font-medium hover:bg-white/10 transition text-sm uppercase tracking-wide"
                    :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/10'">
                    Home
                </a>
                <a href="{{ route('trips-page.index') }}"
                    class="px-4 py-3 rounded-xl font-medium hover:bg-white/10 transition text-sm uppercase tracking-wide"
                    :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/10'">
                    Destinations
                </a>
                <a href="{{ route('blog-page.index') }}"
                    class="px-4 py-3 rounded-xl font-medium hover:bg-white/10 transition text-sm uppercase tracking-wide"
                    :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/10'">
                    Stories
                </a>
            </div>

            {{-- Mobile Auth Section --}}
            <div class="mt-4 pt-4 border-t" :class="scrolled ? 'border-gray-200' : 'border-white/20'">
                @auth
                    <div class="flex items-center gap-3 px-4 py-3">
                        <div
                            class="h-10 w-10 rounded-full bg-accent-500 flex items-center justify-center text-white font-serif font-bold shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs opacity-70">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-3 rounded-xl font-medium transition text-sm"
                            :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/10'">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Dashboard Admin
                            </span>
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}"
                            class="block px-4 py-3 rounded-xl font-medium transition text-sm"
                            :class="scrolled ? 'hover:bg-gray-100' : 'hover:bg-white/10'">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                Dashboard
                            </span>
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit"
                            class="w-full text-left px-4 py-3 rounded-xl font-medium text-red-500 transition text-sm"
                            :class="scrolled ? 'hover:bg-red-50' : 'hover:bg-white/10'">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                Log Out
                            </span>
                        </button>
                    </form>
                @else
                    <div class="flex flex-col gap-3 px-4">
                        <a href="{{ route('login') }}"
                            class="w-full py-3 text-center rounded-xl font-bold text-sm border-2 transition"
                            :class="scrolled ? 'border-gray-300 hover:bg-gray-100' : 'border-white/30 hover:bg-white/10'">
                            Log In
                        </a>
                        <a href="{{ route('register') }}"
                            class="w-full py-3 text-center bg-accent-500 hover:bg-accent-600 text-white rounded-xl font-bold text-sm shadow-lg transition">
                            Sign Up
                        </a>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>
