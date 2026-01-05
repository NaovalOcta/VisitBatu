<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
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

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>

<body class="bg-gray-50 font-sans text-gray-700 antialiased" x-data="{ sidebarOpen: false }">

    <div class="flex h-screen overflow-hidden">

        {{-- 1. Sidebar (Desktop & Mobile) --}}
        <aside
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 shadow-lg lg:shadow-none"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

            {{-- Header Sidebar --}}
            <div class="flex items-center justify-between h-20 px-8 border-b border-gray-50">
                <a href="{{ route('welcome_page') }}" class="group">
                    <span
                        class="font-serif text-2xl font-bold text-gray-900 group-hover:text-teal-600 transition">Visit<span
                            class="text-teal-500">Batu</span></span>
                    <p class="text-[10px] tracking-[0.2em] text-gray-400 font-bold mt-1 uppercase">Admin Panel</p>
                </a>
                {{-- Close Button (Mobile Only) --}}
                <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600">
                    <i class="icon-close text-xl"></i>
                </button>
            </div>

            {{-- Menu Items --}}
            <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-5rem)]">
                <p class="px-4 pt-4 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">Main Menu</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/dashboard') ? 'bg-teal-50 text-teal-700 shadow-sm ring-1 ring-teal-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i
                        class="icon-dashboard mr-3 text-lg {{ Request::is('admin/dashboard') ? 'text-teal-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    Dashboard
                </a>

                <a href="{{ route('admin.trips.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/trips*') ? 'bg-teal-50 text-teal-700 shadow-sm ring-1 ring-teal-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i
                        class="icon-map mr-3 text-lg {{ Request::is('admin/trips*') ? 'text-teal-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    Kelola Wisata
                </a>

                <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group {{ Request::is('admin/categories*') ? 'bg-teal-50 text-teal-700 shadow-sm ring-1 ring-teal-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i
                        class="icon-list mr-3 text-lg {{ Request::is('admin/categories*') ? 'text-teal-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    Kategori Wisata
                </a>

                <a href="{{ route('admin.posts.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 group
                   {{ Request::is('admin/posts*') ? 'bg-teal-50 text-teal-700 shadow-sm ring-1 ring-teal-100' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                    <i
                        class="icon-pencil mr-3 text-lg {{ Request::is('admin/posts*') ? 'text-teal-600' : 'text-gray-400 group-hover:text-gray-600' }}"></i>
                    Blog & Cerita
                </a>

                <p class="px-4 pt-6 pb-2 text-[10px] font-bold text-gray-400 uppercase tracking-wider">System</p>

                <a href="{{ route('welcome_page') }}" target="_blank"
                    class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 rounded-xl hover:bg-gray-50 hover:text-gray-900 transition-all duration-200 group">
                    <i class="icon-external-link mr-3 text-lg text-gray-400 group-hover:text-gray-600"></i>
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
                class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-6 lg:px-10 sticky top-0 z-30">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true"
                        class="lg:hidden p-2 text-gray-500 hover:bg-gray-100 rounded-lg">
                        <i class="icon-menu text-xl"></i>
                    </button>
                    <div class="hidden md:block">
                        <h1 class="font-serif text-lg font-bold text-gray-900">
                            @yield('page_title', 'Dashboard')
                        </h1>
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <div class="flex items-center gap-3">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-900">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">Administrator</p>
                        </div>
                        <div
                            class="h-10 w-10 rounded-full bg-teal-100 flex items-center justify-center text-teal-700 font-bold border-2 border-white shadow-sm ring-1 ring-gray-100">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-full transition-all"
                            title="Logout">
                            <i class="icon-sign-out text-xl"></i>
                        </button>
                    </form>
                </div>
            </header>

            {{-- Main Content Scrollable Area --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-8 lg:p-10 scroll-smooth">
                @yield('admin_content')

                <footer class="mt-10 pt-6 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400">&copy; {{ date('Y') }} VisitBatu Admin Panel. All rights
                        reserved.</p>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>
