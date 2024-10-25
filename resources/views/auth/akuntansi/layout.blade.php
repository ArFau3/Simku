<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Simku</title>
    <link href="css/style.css" rel="stylesheet">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    {{-- <link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'> --}}
</head>

<body class="text-zinc-100 antialiased">
    <div class="min-h-screen flex flex-col w-full my-1 bg-zinc-800">
        {{-- SECTION Header --}}
        <div class="h-1/6 bg-zinc-600/75 mt-4 mb-1.5 mx-1.5 sm:mx-5 py-2 px-3 rounded flex justify-between">
            <div class="">
                {{-- TODO: logo dan data simku, karna koperasi blm masuk jadi tidak bisa pakai itu --}}
                <img src="/assets/logo.png" alt="logo.png"
                    class="object-contain float-left sm:h-full max-h-20 sm:w-20 flex-shrink-0 mr-2">
                <div class="leading-4 float-left">
                    <h3 class="sm:leading-7 font-bold sm:text-xl">SISTEM INFORMASI AKUNTANSI</h3>
                    <div class="text-xs sm:text-base sm:leading-4">
                        <p>Koperasi Unit Desa (KUD) Tapang Dadap</p>
                        <p>Nomor : 0003967//BH/M.KUKM.2/IV/2017</p>
                    </div>
                </div>
            </div>
            <img src="/assets/logo-sekadau.png" alt="logo-sekadau.png"
                class="object-contain float-right h-5/6 sm:h-full w-20 mr-2">
        </div>
        {{-- END SECTION Header --}}
        {{-- SECTION Body --}}
        <div class="sm:absolute w-full h-screen  sm:mt-0 mt-10 flex flex-col justify-center items-center">
            @yield('content')
        </div>
        {{-- END SECTION Body --}}
        {{-- SECTION Footer --}}
        <div class="container fixed bottom-0 min-w-full -mt-2 self-end py-1 border border-slate-400 bg-zinc-500/75">
            <p class="text-center text-sm">Copyright &copy; Koperasi Sekadau 2023</p>
        </div>
        {{-- END SECTION Footer --}}
    </div>
</body>
<script type="text/javascript">
    function DoSubmit(item, nomor) {
        console.log(item);
        $("input[data-type='nomor_otp']").val(nomor);
        document.getElementById(item).submit();
    }
</script>
