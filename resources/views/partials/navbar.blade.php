@php
    $hasHero = request()->routeIs('welcome_page') || request()->routeIs('trips-page.index') || request()->routeIs('blog-page.index');
@endphp
<nav x-data="{ scrolled: false, mobileOpen: false, hasHero: {{ $hasHero ? 'true' : 'false' }} }"
    @scroll.window="scrolled = (window.pageYOffset > 50)"
    :class="(scrolled || !hasHero)
        ? 'glass-effect py-3 shadow-sm text-gray-800 dark:text-white'
        : 'bg-transparent py-6 text-white drop-shadow-md'"
    class="fixed w-full z-50 transition-all duration-300 top-0 left-0">

    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center">

            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div :class="(scrolled || !hasHero) ? 'bg-primary-800 text-white dark:bg-primary-600' : 'bg-white text-primary-900'"
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
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">{{ __('Home') }}</a>
                <a href="{{ route('trips-page.index') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">{{ __('Destinations') }}</a>
                <a href="{{ route('blog-page.index') }}"
                    class="font-medium hover:text-accent-500 transition tracking-wide text-sm uppercase">{{ __('Blog') }}</a>
            </div>

            {{-- Desktop Actions (Lang & Notif) --}}
            <div class="hidden md:flex items-center gap-4">
                {{-- Language Switcher --}}
                <div class="flex items-center bg-white/10 dark:bg-night-800/50 rounded-full p-1 border border-white/20 dark:border-night-700/50" :class="(scrolled || !hasHero) ? 'bg-gray-100 border-gray-200 dark:bg-night-800/80 dark:border-night-700' : ''">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-2 py-1 text-[10px] font-bold rounded-full transition {{ app()->getLocale() == 'id' ? 'bg-accent-500 text-white shadow-sm' : 'text-gray-400 hover:text-white dark:text-white/60 dark:hover:text-white' }}"
                       :class="(scrolled || !hasHero) && app()->getLocale() != 'id' ? 'text-gray-500 hover:text-gray-800 dark:hover:text-white' : ''">
                       ID
                     </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-2 py-1 text-[10px] font-bold rounded-full transition {{ app()->getLocale() == 'en' ? 'bg-accent-500 text-white shadow-sm' : 'text-gray-400 hover:text-white dark:text-white/60 dark:hover:text-white' }}"
                       :class="(scrolled || !hasHero) && app()->getLocale() != 'en' ? 'text-gray-500 hover:text-gray-800 dark:hover:text-white' : ''">
                       EN
                     </a>
                </div>

                {{-- Dark Mode Toggle --}}
                <button @click="darkMode = !darkMode"
                    type="button"
                    class="p-2 rounded-full transition-all duration-300 hover:bg-white/10 dark:hover:bg-night-800/50 focus:outline-none"
                    :class="(scrolled || !hasHero) ? 'text-gray-600 dark:text-white/70 hover:bg-gray-100 dark:hover:bg-night-800' : 'text-white/80 hover:text-white'">
                    <template x-if="!darkMode">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                    </template>
                    <template x-if="darkMode">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-accent-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </template>
                </button>

                @auth
                {{-- Notification Bell --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="relative p-2 rounded-full transition hover:bg-white/10 dark:hover:bg-night-800/50 focus:outline-none" :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800 text-gray-600 dark:text-white/70' : 'text-white/80 hover:text-white'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="absolute top-1.5 right-1.5 flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                        </span>
                        @endif
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition
                        class="absolute right-0 mt-3 w-80 bg-white dark:bg-night-900 text-gray-800 dark:text-white rounded-2xl shadow-2xl border border-gray-100 dark:border-night-800 py-4 z-50 overflow-hidden">
                        <div class="px-4 pb-3 border-b border-gray-100 dark:border-night-800 flex justify-between items-center">
                            <h3 class="font-bold text-sm">Notifikasi</h3>
                            @if(auth()->user()->unreadNotifications->count() > 0)
                            <form action="{{ route('notifications.mark-as-read') }}" method="POST">
                                @csrf
                                <button type="submit" class="text-[10px] text-primary-600 dark:text-primary-400 font-bold hover:underline">Tandai semua dibaca</button>
                            </form>
                            @endif
                        </div>
                        <div class="max-h-96 overflow-y-auto">
                            @forelse(auth()->user()->notifications->take(5) as $notification)
                            <div class="px-4 py-3 {{ $notification->read_at ? 'opacity-60' : 'bg-primary-50/50 dark:bg-primary-900/20' }} border-b border-gray-50 dark:border-night-800 last:border-0">
                                <p class="text-xs font-medium">{{ $notification->data['message'] }}</p>
                                <p class="text-[10px] text-gray-400 dark:text-white/50 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                            @empty
                            <div class="px-4 py-8 text-center">
                                <p class="text-xs text-gray-400 dark:text-white/50">Tidak ada notifikasi baru.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                @endauth
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
                            <div class="h-9 w-9 rounded-full border border-gray-100 dark:border-night-700 shadow-md overflow-hidden">
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                        </button>
                        <div x-show="open" x-transition
                            class="absolute right-0 mt-3 w-48 bg-white dark:bg-night-900 text-gray-800 dark:text-white rounded-xl shadow-xl border border-gray-100 dark:border-night-800 py-2 overflow-hidden">

                            {{-- LOGIKA PENGECEKAN ROLE --}}
                            @if (Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-night-800">
                                    {{ __('Dashboard') }}
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="block px-4 py-2 hover:bg-gray-50 dark:hover:bg-night-800">
                                    {{ __('Dashboard') }}
                                </a>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="font-bold text-sm hover:underline decoration-accent-500 decoration-2 underline-offset-4">{{ __('Log In') }}
                    </a>
                    <a href="{{ route('register') }}"
                        class="px-5 py-2.5 bg-accent-500 hover:bg-accent-600 text-white rounded-full text-sm font-bold shadow-lg shadow-accent-500/30 transition transform hover:-translate-y-0.5">{{ __('Sign Up') }}
                    </a>
                @endauth
            </div>

            {{-- Mobile Hamburger Button --}}
            <button @click="mobileOpen = !mobileOpen"
                class="md:hidden p-2 rounded-lg hover:bg-white/10 dark:hover:bg-night-800 transition focus:outline-none"
                :class="(scrolled || !hasHero) ? 'text-gray-800 dark:text-white' : 'text-white'">
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
            :class="(scrolled || !hasHero) ? 'border-gray-200 dark:border-night-800' : 'border-white/20 dark:border-night-800/50'">

            <div class="flex items-center justify-between px-4 pt-4 pb-2">
                <span class="text-[10px] font-bold uppercase tracking-widest opacity-60">Language</span>
                <div class="flex items-center bg-white/10 dark:bg-night-800/50 rounded-full p-1 border border-white/20 dark:border-night-700/50" :class="(scrolled || !hasHero) ? 'bg-gray-100 border-gray-200 dark:bg-night-800/80 dark:border-night-700' : ''">
                    <a href="{{ route('lang.switch', 'id') }}"
                       class="px-3 py-1 text-[10px] font-bold rounded-full transition {{ app()->getLocale() == 'id' ? 'bg-accent-500 text-white shadow-sm' : 'text-gray-400 dark:text-white/60' }}"
                       :class="(scrolled || !hasHero) && app()->getLocale() != 'id' ? 'text-gray-500 hover:text-gray-800 dark:hover:text-white' : ''">
                       ID
                    </a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-3 py-1 text-[10px] font-bold rounded-full transition {{ app()->getLocale() == 'en' ? 'bg-accent-500 text-white shadow-sm' : 'text-gray-400 dark:text-white/60' }}"
                       :class="(scrolled || !hasHero) && app()->getLocale() != 'en' ? 'text-gray-500 hover:text-gray-800 dark:hover:text-white' : ''">
                       EN
                    </a>
                </div>

                {{-- Mobile Theme Toggle --}}
                <button @click="darkMode = !darkMode"
                    type="button"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-full border transition border-white/20 dark:border-night-700/50"
                    :class="darkMode ? 'bg-night-800 text-accent-400 border-accent-500/30' : 'bg-white/10 text-white'">
                    <span x-show="!darkMode" class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <span class="text-[10px] font-bold uppercase">Dark</span>
                    </span>
                    <span x-show="darkMode" x-cloak class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="text-[10px] font-bold uppercase">Light</span>
                    </span>
                </button>
            </div>

            <div class="flex flex-col space-y-1 pt-2">
                <a href="{{ route('welcome_page') }}"
                    class="px-4 py-3 rounded-xl font-medium transition text-sm uppercase tracking-wide"
                    :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800' : 'hover:bg-white/10'">
                    {{ __('Home') }}
                </a>
                <a href="{{ route('trips-page.index') }}"
                    class="px-4 py-3 rounded-xl font-medium transition text-sm uppercase tracking-wide"
                    :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800' : 'hover:bg-white/10'">
                    {{ __('Destinations') }}
                </a>
                <a href="{{ route('blog-page.index') }}"
                    class="px-4 py-3 rounded-xl font-medium transition text-sm uppercase tracking-wide"
                    :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800' : 'hover:bg-white/10'">
                    {{ __('Blog') }}
                </a>
            </div>

            {{-- Mobile Auth Section --}}
            <div class="mt-4 pt-4 border-t" :class="(scrolled || !hasHero) ? 'border-gray-200 dark:border-night-800' : 'border-white/20 dark:border-night-800/50'">
                @auth
                    <div class="flex items-center gap-3 px-4 py-3">
                        <div class="h-10 w-10 rounded-full border border-white/20 shadow-md overflow-hidden">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-bold text-sm">{{ Auth::user()->name }}</p>
                            <p class="text-xs opacity-70">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}"
                            class="block px-4 py-3 rounded-xl font-medium transition text-sm"
                            :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800' : 'hover:bg-white/10'">
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
                            :class="(scrolled || !hasHero) ? 'hover:bg-gray-100 dark:hover:bg-night-800' : 'hover:bg-white/10'">
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
                            :class="(scrolled || !hasHero) ? 'hover:bg-red-50 dark:hover:bg-red-900/20' : 'hover:bg-white/10'">
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
                            :class="(scrolled || !hasHero) ? 'border-gray-300 hover:bg-gray-100 dark:border-night-700 dark:hover:bg-night-800' : 'border-white/30 hover:bg-white/10'">
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
