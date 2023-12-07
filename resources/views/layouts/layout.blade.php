<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title; ?></title>
    @vite('resources/css/app.css')



    <!--<link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'>
        -->
</head>
    <body>
    @include('layouts.sidebar')
       <div class="w-auto bg-slate-200 p-5 flex justify-between">
        <div>
        <img src="/assets/logo.png" alt="logo.png" class="float-left h-full w-20 mr-2">
        <div class="leading-4 float-left h-full">
        <h3 class="leading-7 font-bold text-xl">KOPERASI SEKADAU CORP</h3>
        <p>E-Koperasi Kalimantan Barat Terintegrasi</p>
        <p>Sekadau No.9 20/003 Sekadau-KalBar</p>
    </div>
</div>
    <img src="/assets/logo-sekadau.png" alt="logo-sekadau.png" class="float-right w-20 mr-2">
       </div>
 
        <div class="container">
            @yield('content')
        </div>

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
    </body>
</html>