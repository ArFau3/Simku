@extends('layouts.app')

@section('title', 'SIMAMPU')

@section('content')
<section class="bg-white">
    <div class="container flex flex-col items-center px-4 py-12 mx-auto xl:flex-row">
        <div class="flex justify-center xl:w-1/2">
            <img class="h-80 w-80 sm:w-[28rem] sm:h-[28rem] flex-shrink-0 object-cover rounded-full" src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1974&q=80" alt="">
        </div>

        <div class="flex flex-col items-center mt-6 xl:items-start xl:w-1/2 xl:mt-0 font-inter">
            <h2 class="text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl">
                Selamat Datang di SIMAMPU
            </h2>

            <p class="block max-w-2xl mt-4 text-gray-500">Tekan <b>Lihat Selengkapnya</b> untuk mengetahui lebih lanjut. Gracias!!</p>

            <div class="mt-6 sm:-mx-2">
                <a href="{{ url('/beranda') }}" class="inline-flex items-center justify-center w-full px-4 text-sm py-2.5 overflow-hidden text-white transition-colors duration-300 bg-indigo-500 rounded-lg shadow sm:w-auto sm:mx-2 hover:bg-indigo-800 focus:ring focus:ring-gray-300 focus:ring-opacity-80">
                    <span class="mx-2">
                        Lihat Selengkapnya
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection