<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | Simku</title>
    @vite('resources/css/app.css')



    {{-- <link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'> --}}
</head>

<body class="">
    @include('layouts.sidebar')
    <div class="lg:w-5/6 lg:float-right border my-1 min-h-screen">
        <div class="bg-white p-3 sm:p-5 flex justify-between">
            <div class="">
                <img src="/assets/logo.png" alt="logo.png"
                    class="object-contain float-left sm:h-full max-h-20 sm:w-20 flex-shrink-0 mr-2">
                <div class="leading-4 float-left pt-3">
                    <h3 class="sm:leading-7 font-bold sm:text-xl">SISTEM INFORMASI AKUNTANSI</h3>
                    <div class="text-xs sm:text-base">
                        <p>Koperasi Perkebunan Kabupaten Sekadau</p>
                        <p>Sekadau No.9 20/003 Sekadau-KalBar</p>
                    </div>
                </div>
            </div>
            <img src="/assets/logo-sekadau.png" alt="logo-sekadau.png"
                class="object-contain float-right h-5/6 sm:h-full w-20 mr-2">
        </div>
        <div class="container min-w-full py-1 border-2 border-slate-300 bg-zinc-300">
            <p class="text-end text-sm pr-3">Tapang Dadap -
                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                {{ strftime('%A, %d %B %Y %H:%M', time()) }} WIB
            </p>
        </div>
        <div class="min-h-screen">
            <div class="pt-3 px-2">
                <div class="rounded-lg bg-zinc-200 px-4 py-6">
                    <h1 class="text-2xl font-bold mb-4">{{ $judul }}</h1>
                    <div class="bg-zinc-50 p-2 rounded">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <div class="container min-w-full -mt-2 self-end py-1 border border-slate-400 bg-zinc-300">
            <p class="text-center text-sm">Copyright &copy; Koperasi Sekadau 2023</p>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    let menu1 = document.getElementById("menu1");
    const showMenu1 = (flag) => {
        if (flag) {
            icon1.classList.toggle("rotate-180");
            menuHeader1.classList.toggle("text-indigo-400")
            menu1.classList.toggle("hidden");
        }
    };
    let menu2 = document.getElementById("menu2");
    const showMenu2 = (flag) => {
        if (flag) {

            icon2.classList.toggle("rotate-180");
            menuHeader2.classList.toggle("text-indigo-400")
            menu2.classList.toggle("hidden");
        }
    };
</script>
