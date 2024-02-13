@extends('supplier.layouts.app')

@section('title', 'SIMAMPU - Beranda')

@section('content')
<div>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        <!-- sidebar -->
        @include('supplier.layouts.partials.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">

            <!-- navbar -->
            @include('supplier.layouts.partials.navbar')

            <!-- Isi Konten -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-semibold text-gray-700 font-inter">Beranda</h3>

                    <div class="mt-4"></div>

                    <!-- Konten -->
                    <div class="bg-white font-inter">
                        <div class="text-center w-full mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 z-20">
                            <h2 class="text-3xl font-extrabold text-black sm:text-4xl">
                                <span class="block">
                                    Kosong ?
                                </span>
                                <span class="block text-indigo-500 mt-3">
                                    Ya Benar. Masih kosong nih edit 2.
                                </span>
                            </h2>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
@endsection