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
    <title>Admin Dashboard - VisitBatu</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Icomoon Icons (Tetap digunakan) --}}
    <link rel="stylesheet" href="{{ asset('fonts/icomoon/style.css') }}">

    {{-- Load Tailwind & Alpine via Vite (Sama seperti frontend) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Kustomisasi scrollbar agar lebih rapi */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .dark ::-webkit-scrollbar-track {
            background: #0f1117;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .dark ::-webkit-scrollbar-thumb {
            background: #1c2030;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        .dark ::-webkit-scrollbar-thumb:hover {
            background: #22c55e;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-50 dark:bg-night-950 font-sans text-gray-700 dark:text-white antialiased transition-colors duration-300" 
    x-data="{ sidebarOpen: false, darkMode: window.initializeTheme() }"
    x-init="$watch('darkMode', val => { 
        localStorage.setItem('darkMode', val); 
        if(val) document.documentElement.classList.add('dark'); 
        else document.documentElement.classList.remove('dark');
    })">
    <div class="flex h-screen overflow-hidden">
        {{-- 1. Sidebar (Desktop & Mobile) --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-night-800 border-r border-gray-100 dark:border-night-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-lg lg:shadow-none"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Header Sidebar --}}
            <div class="flex items-center justify-between h-20 px-8 border-b border-gray-50 dark:border-night-700">
                <a href="{{ route('welcome_page') }}" class="group">
                    <span class="font-serif text-2xl font-bold text-gray-900 dark:text-white group-hover:text-teal-600 dark:group-hover:text-accent-400 transition">
                        Visit<span class="text-teal-500 dark:text-accent-400">Batu</span>
                    </span>
                    <p class="text-[10px] tracking-[0.2em] text-gray-400 dark:text-white/50 font-bold mt-1 uppercase">Admin Panel</p>
                </a>

                {{-- Close Button (Mobile Only) --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600 dark:text-white/60 dark:hover:text-white">
                    <i class="icon-close text-xl"></i>
                </button>
            </div>

            {{-- Menu Items --}}
            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)]">
                <p class="px-4 pt-4 pb-2 text-[10px] font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/dashboard') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white shadow-sm ring-1 ring-teal-100 dark:ring-night-600' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white' }}">
                    <i
                        class="icon-dashboard mr-3 text-lg {{ Request::is('admin/dashboard') ? 'text-teal-600 dark:text-accent-400' : 'text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60' }}"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.trips.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/trips*') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white shadow-sm ring-1 ring-teal-100 dark:ring-night-600' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white' }}">
                    <i
                        class="icon-map mr-3 text-lg {{ Request::is('admin/trips*') ? 'text-teal-600 dark:text-accent-400' : 'text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60' }}"></i>
                    Kelola Wisata
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/categories*') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white shadow-sm ring-1 ring-teal-100 dark:ring-night-600' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white' }}">
                    <i
                        class="icon-list mr-3 text-lg {{ Request::is('admin/categories*') ? 'text-teal-600 dark:text-accent-400' : 'text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60' }}"></i>
                    Kategori Wisata
                </a>

                <a href="{{ route('admin.posts.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/posts*') ? 'bg-teal-50 text-teal-700 dark:bg-night-700 dark:text-white shadow-sm ring-1 ring-teal-100 dark:ring-night-600' : 'text-gray-600 dark:text-white/60 hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white' }}">
                    <i
                        class="icon-pencil mr-3 text-lg {{ Request::is('admin/posts*') ? 'text-teal-600 dark:text-accent-400' : 'text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60' }}"></i>
                    Blog & Cerita
                </a>

                <p class="px-4 pt-6 pb-2 text-[10px] font-bold text-gray-400 dark:text-white/50 uppercase tracking-wider">System</p>

                <a href="{{ route('admin.profile.edit') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-white/60 rounded-xl hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white transition-all duration-200 group">
                    <i class="icon-user mr-3 text-lg text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60"></i>
                    Pengaturan Profil
                </a>

                <a href="{{ route('welcome_page') }}" target="_blank"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 dark:text-white/60 rounded-xl hover:bg-gray-50 dark:hover:bg-night-900 hover:text-gray-900 dark:hover:text-white transition-all duration-200 group">
                    <i class="icon-external-link mr-3 text-lg text-gray-400 dark:text-white/40 group-hover:text-gray-600 dark:group-hover:text-white/60"></i>
                    Lihat Website
                </a>
            </nav>
        </aside>

        {{-- Overlay Background (Mobile) --}}
        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition.opacity
            class="fixed inset-0 z-40 bg-gray-900/50 backdrop-blur-sm lg:hidden"></div>

        {{-- 2. Main Content Wrapper --}}
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

            {{-- Top Navbar --}}
            <header
                class="h-20 bg-white/80 dark:bg-night-800/80 backdrop-blur-md border-b border-gray-100 dark:border-night-700 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-30 transition-colors duration-300">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 dark:hover:bg-night-700 rounded-lg">
                        <i class="icon-menu text-xl"></i>
                    </button>
                    <div class="hidden md:block">
                        <h1 class="font-serif text-2xl font-bold text-gray-900 dark:text-white">
                            @yield('page_title', 'Dashboard')
                        </h1>
                    </div>
                </div>

                <div class="flex items-center gap-6">
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

                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900 dark:text-white">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 dark:text-white/60">Administrator</p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full border-2 border-white dark:border-night-700 shadow-sm ring-1 ring-gray-100 dark:ring-night-700 overflow-hidden">
                            <img src="{{ Auth::user()->avatar_url }}" alt="{{ Auth::user()->name }}"
                                class="w-full h-full object-cover">
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-full transition-all"
                            title="Logout">
                            <i class="icon-sign-out text-xl"></i>
                        </button>
                    </form>
                </div>
            </header>

            {{-- Main Content Scrollable Area --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-8 lg:p-10 scroll-smooth">
                @yield('admin_content')

                <footer class="mt-10 pt-6 border-t border-gray-100 dark:border-night-700 text-center">
                    <p class="text-xs text-gray-400 dark:text-white/50">&copy;
                        {{ date('Y') }} VisitBatu Admin Panel. All rights reserved.</p>
                </footer>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>
