<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS (gunakan jika project kamu sebelumnya pakai Bootstrap) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tailwind dari Breeze (tidak wajib, tapi biar auth page tetap rapi) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    {{-- Navbar dari Breeze (otomatis tampil kalau user login) --}}
    @auth
        @include('layouts.navigation')
    @endauth

    <main class="py-4">
        {{-- Ini area utama halaman (isi tiap view seperti invoices.index, create, dll) --}}
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle (Popper + JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
