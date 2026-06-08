<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <script>
        window.initializeTheme = () => {
            const isDark = localStorage.getItem('darkMode') === 'true' || 
                         (!('darkMode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
            if (isDark) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            return isDark;
        };
        window.initializeTheme();
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna - VisitBatu</title>

    {{-- Fonts (Sama dengan Admin) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Icomoon --}}
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    {{-- Tailwind & Alpine via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-50 dark:bg-night-950 font-sans text-gray-700 dark:text-white antialiased flex flex-col min-h-screen transition-colors duration-300" 
    x-data="{ mobileMenuOpen: false, darkMode: window.initializeTheme() }"
    x-init="$watch('darkMode', val => { 
        localStorage.setItem('darkMode', val); 
        if(val) document.documentElement.classList.add('dark'); 
        else document.documentElement.classList.remove('dark');
    })">

    {{-- Navbar User --}}
    <nav class="bg-white dark:bg-night-800 border-b border-gray-100 dark:border-night-700 sticky top-0 z-50 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">

                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('welcome_page') }}" class="flex flex-col group">
                        <span
                            class="font-serif text-2xl font-bold text-gray-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-accent-400 transition">Visit<span
                                class="text-teal-500 dark:text-accent-400">Batu</span></span>
                    </a>

                    {{-- Desktop Menu --}}
                    <div class="hidden md:flex md:ml-10 md:space-x-8">
                        <a href="{{ route('user.dashboard') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                           {{ Request::is('user/dashboard-user') ? 'border-teal-500 text-gray-900 dark:border-accent-400 dark:text-white' : 'border-transparent text-gray-500 dark:text-white/60 hover:text-teal-600 dark:hover:text-white hover:border-teal-300 dark:hover:border-accent-400' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('user.posts.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                           {{ Request::is('user/posts*') ? 'border-teal-500 text-gray-900 dark:border-accent-400 dark:text-white' : 'border-transparent text-gray-500 dark:text-white/60 hover:text-teal-600 dark:hover:text-white hover:border-teal-300 dark:hover:border-accent-400' }}">
                            Cerita Saya
                        </a>
                    </div>
                </div>

                {{-- User Dropdown --}}
                <div class="hidden md:flex items-center gap-4">
                    {{-- Dark Mode Toggle --}}
                    <button @click="darkMode = !darkMode"
                        type="button"
                        class="p-2 rounded-full transition-all duration-300 hover:bg-gray-100 dark:hover:bg-night-700 focus:outline-none text-gray-600 dark:text-white/60">
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

                    <span class="text-sm text-gray-500 dark:text-white/60">Halo, <span
                            class="font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</span></span>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <div
                                class="h-10 w-10 rounded-full border-2 border-white dark:border-night-700 shadow-sm ring-1 ring-gray-100 dark:ring-night-700 hover:ring-teal-200 dark:hover:ring-accent-400 transition-all overflow-hidden">
                                <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white dark:bg-night-800 rounded-xl shadow-lg py-1 ring-1 ring-black dark:ring-night-700 ring-opacity-5 focus:outline-none"
                            x-cloak>
                            <a href="{{ route('user.profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 dark:hover:text-white">
                                <i class="icon-user mr-2"></i> Pengaturan Profil
                            </a>
                            <a href="{{ route('welcome_page') }}"
                                class="block px-4 py-2 text-sm text-gray-700 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 dark:hover:text-white">
                                <i class="icon-home mr-2"></i> Halaman Utama
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-950/30">
                                    <i class="icon-sign-out mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Mobile Hamburger --}}
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-white/60 hover:text-gray-500 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-night-700 focus:outline-none">
                        <i class="icon-menu text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" class="md:hidden bg-white dark:bg-night-800 border-t border-gray-100 dark:border-night-700" x-transition>
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('user.dashboard') }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium rounded-lg {{ Request::is('user/dashboard-user') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900/50 dark:hover:text-white' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.posts.index') }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium rounded-lg {{ Request::is('user/posts*') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900/50 dark:hover:text-white' }}">
                    Cerita Saya
                </a>
                <a href="{{ route('user.profile.edit') }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium rounded-lg {{ Request::is('user/profile*') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900/50 dark:hover:text-white' }}">
                    Pengaturan Profil
                </a>
            </div>
            <div class="pt-4 pb-4 border-t border-gray-100 dark:border-night-700 px-4">
                <div class="flex items-center mb-3">
                    <div class="flex-shrink-0">
                        <div class="h-10 w-10 rounded-full overflow-hidden border border-gray-200 dark:border-night-700">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800 dark:text-white">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500 dark:text-white/60">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-red-500 hover:bg-red-600">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-10 flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @yield('user_content')
        </div>
    </main>

    <footer class="bg-white dark:bg-night-800 border-t border-gray-100 dark:border-night-700 py-6 mt-auto transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-gray-400 dark:text-white/50">&copy; {{ date('Y') }} VisitBatu User Panel. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
