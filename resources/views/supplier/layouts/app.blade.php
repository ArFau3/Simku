<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sistem Informasi Supplier Koperasi Sekadau">

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400&display=swap" rel="stylesheet">

    <!-- boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- gambar head -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/koperasi2.ico') }}">

    <!-- animasi modal hapus data -->
    <link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css" />

    <!-- script setiap halaman -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <!-- title web -->
    <title>@yield('title')</title>

    <!-- tailwind css -->
    @vite('resources/css/app.css')

</head>

<body>
    @yield('content')
</body>

</html>