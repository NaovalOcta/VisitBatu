<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'VisitBatu') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Script inisialisasi tema sebelum render body -->
    <script>
        window.initializeTheme = () => {
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                return true;
            } else {
                document.documentElement.classList.remove('dark');
                return false;
            }
        };
        // Jalankan segera
        window.initializeTheme();
    </script>
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-50 flex items-center justify-center min-h-screen dark:bg-slate-900 dark:text-slate-100 transition-colors duration-300"
    x-data="{ darkMode: false }"
    x-init="
        darkMode = window.initializeTheme();
        $watch('darkMode', val => {
            if (val) {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
            }
        });
    ">
    @yield('content')

    <script>
        // Konfigurasi Toast (Notifikasi Kecil di Pojok)
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Cek Session Success (Berhasil)
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        // Cek Session Error (Gagal) - Menggunakan Modal Tengah agar lebih diperhatikan
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonColor: '#0d9488', // Sesuaikan dengan warna tema web Anda (Teal)
            });
        @endif

        // Cek Validasi Error (Jika ada error input form)
        @if ($errors->any())
            Toast.fire({
                icon: 'warning',
                title: 'Mohon periksa kembali inputan Anda.'
            });
        @endif
    </script>
</body>

</html>
