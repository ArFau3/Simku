<!doctype html>
<html lang="en">
{{-- FIXME: tidak bisa pakai css terpisah --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Data | Simku</title>
    {{-- <link href="/css/style.css" rel="stylesheet"> --}}
    @vite('resources/css/app.css')
    {{-- <style>
        
    </style> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'> --}}
</head>

<body>
    <div class="text-center mb-7">
        {{-- FIXME: font --}}
        <p class="text-xl antialiased uppercase font-bold">{{ $user->koperasi->nama }}</p>
        <p class="font-semibold antialiased ">Badan Hukum Nomor: {{ $user->koperasi->hukum }}</p>
        <p class="font-semibold antialiased">Alamat: {{ $user->koperasi->alamat }}</p>
        <hr class="border-double border-4 border-y-zinc-900 my-2 bg-transparent">
        @yield('content')
    </div>
</body>

</html>
