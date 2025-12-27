<!doctype html>
<html lang="en">

<head>
    <title>@yield('title', 'Trips Travel')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>

<body>
    <div class="site-wrap">
        @yield('content')
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'slide',
            once: true
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Konfigurasi Toast (Notifikasi Kecil)
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end', // Muncul di pojok kanan atas
            showConfirmButton: false,
            timer: 3000, // Hilang setelah 3 detik
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Cek apakah ada Session 'success' dari Controller
        @if (session('success'))
            Toast.fire({
                icon: 'success',
                title: '{{ session('success') }}'
            });
        @endif

        // Cek apakah ada Session 'error'
        @if (session('error'))
            Toast.fire({
                icon: 'error',
                title: '{{ session('error') }}'
            });
        @endif

        // Cek apakah ada error validasi (opsional, agar user sadar ada yang salah)
        @if ($errors->any())
            Toast.fire({
                icon: 'error',
                title: 'Ada kesalahan pada input Anda.'
            });
        @endif
    </script>
</body>

</html>
