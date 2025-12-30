<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
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

<body class="bg-gray-50 font-sans text-gray-700 antialiased flex flex-col min-h-screen" x-data="{ mobileMenuOpen: false }">

    {{-- Navbar User --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">

                {{-- Logo --}}
                <div class="flex items-center">
                    <a href="{{ route('welcome_page') }}" class="flex flex-col group">
                        <span
                            class="font-serif text-2xl font-bold text-gray-900 group-hover:text-teal-600 transition">Visit<span
                                class="text-teal-500">Batu</span></span>
                    </a>

                    {{-- Desktop Menu --}}
                    <div class="hidden md:flex md:ml-10 md:space-x-8">
                        <a href="{{ route('user.dashboard_user') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                           {{ Request::is('user/dashboard-user') ? 'border-teal-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-teal-600 hover:border-teal-300' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('user.posts.index') }}"
                            class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors duration-200
                           {{ Request::is('user/posts*') ? 'border-teal-500 text-gray-900' : 'border-transparent text-gray-500 hover:text-teal-600 hover:border-teal-300' }}">
                            Cerita Saya
                        </a>
                    </div>
                </div>

                {{-- User Dropdown --}}
                <div class="hidden md:flex items-center gap-4">
                    <span class="text-sm text-gray-500">Halo, <span
                            class="font-bold text-gray-900">{{ Auth::user()->name }}</span></span>

                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center focus:outline-none">
                            <div
                                class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold border-2 border-white shadow-sm ring-1 ring-gray-100 hover:ring-teal-200 transition-all">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" @click.away="open = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-1 ring-1 ring-black ring-opacity-5 focus:outline-none"
                            x-cloak>
                            <a href="{{ route('welcome_page') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                <i class="icon-home mr-2"></i> Halaman Utama
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="icon-sign-out mr-2"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Mobile Hamburger --}}
                <div class="-mr-2 flex items-center md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                        <i class="icon-menu text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenuOpen" class="md:hidden bg-white border-t border-gray-100" x-transition>
            <div class="pt-2 pb-3 space-y-1 px-4">
                <a href="{{ route('user.dashboard_user') }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium rounded-lg {{ Request::is('user/dashboard-user') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    Dashboard
                </a>
                <a href="{{ route('user.posts.index') }}"
                    class="block pl-3 pr-4 py-2 text-base font-medium rounded-lg {{ Request::is('user/posts*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:bg-gray-50' }}">
                    Cerita Saya
                </a>
            </div>
            <div class="pt-4 pb-4 border-t border-gray-100 px-4">
                <div class="flex items-center mb-3">
                    <div class="flex-shrink-0">
                        <div
                            class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
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

    <footer class="bg-white border-t border-gray-100 py-6 mt-auto">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm text-gray-400">&copy; {{ date('Y') }} VisitBatu User Panel. All rights reserved.</p>
        </div>
    </footer>

</body>

</html>
