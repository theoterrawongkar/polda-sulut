<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Kepolisian Daerah Sulawesi Utara">
    <meta name="description" content="Website Sistem Informasi Absensi Kepolisian Daerah Sulawesi Utara.">

    <!-- Logo Aplikasi -->
    <link rel="icon" href="{{ asset('img/application-logo.webp') }}" type="image/x-icon">

    <!-- Judul Halaman -->
    <title>Polda Sulut | {{ Str::limit($title, 20) }}</title>

    <!-- Script -->
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Style -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body>

    <main>
        {{ $slot }}
    </main>

</body>

</html>
