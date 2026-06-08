<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <script>
        // Use a function to simplify toggling and ensure persistence
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'VisitBatu - The Jewel of East Java')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] {
            display: none !important;
        }

        /* Efek Kaca untuk Navbar */
        .glass-effect {
            background-color: var(--glass-bg);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
    </style>
    @stack('styles')
</head>

<body 
    x-data="{ darkMode: window.initializeTheme() }" 
    x-init="$watch('darkMode', val => { 
        localStorage.setItem('darkMode', val); 
        if(val) document.documentElement.classList.add('dark'); 
        else document.documentElement.classList.remove('dark');
    })"
    class="antialiased font-sans text-gray-700 dark:text-white bg-gray-50 dark:bg-night-950 flex flex-col min-h-screen transition-colors duration-300">

    @include('partials.navbar')

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html>
