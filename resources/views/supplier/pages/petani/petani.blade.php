@extends('supplier.layouts.app')

@section('title', 'SIMAMPU - Petani')

@section('content')
<div>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"></div>

        <!-- sidebar -->
        @include('supplier.layouts.partials.sidebar')

        <div class="flex flex-col flex-1 overflow-hidden">

            <!-- navbar -->
            @include('supplier.layouts.partials.navbar')

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                <div class="container px-6 py-8 mx-auto">
                    <h3 class="text-3xl font-semibold text-gray-700 font-inter">Petani</h3>

                    <div class="mt-4"></div>

                    <div class="flex flex-wrap -mx-6">

                        <!-- Tombol Tambah Data Petani -->
                        <div class="w-full px-6 font-inter">
                            <div class="flex items-center px-5 py-6 bg-white rounded-md shadow-sm">
                                <button onclick="document.getElementById('modalTambah').showModal()" id="btn" class="w-full md:w-auto text-sm bg-green-500 px-4 py-2 text-white rounded-3xl font-semibold hover:bg-green-800">
                                    <i class='bx bx-plus-medical'></i>
                                    Tambah Data Petani
                                </button>
                            </div>
                        </div>

                        <!-- Tambah Data Petani -->
                        @include('supplier.pages.petani.create_petani')
                    </div>

                    <!-- Tabel -->
                    <div class="mt-4 container mx-auto text-black font-inter">
                        <div class="overflow-x-auto rounded-lg">
                            <table class="min-w-full">
                                <colgroup>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col>
                                    <col class="w-24">
                                </colgroup>
                                <thead class="bg-green-200">
                                    <tr class="text-left">
                                        <th class="p-3">No.</th>
                                        <th class="p-3">Nama Petani</th>
                                        <th class="p-3">Alamat</th>
                                        <th class="p-3">No. Hp</th>
                                        <th class="p-3">Luas Lahan</th>
                                        <th class="p-3">Jenis Varietas</th>
                                        <th class="p-3">Jenis Pupuk</th>
                                        <th class="p-3">Tahun Sawit</th>
                                        <th class="p-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <!-- satu -->
                                    <tr class="border-b border-opacity-20 border-gray-700 bg-white">
                                        <td class="p-3">
                                            <p>1.</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Bambang</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Jl. Gajah Mada</p>
                                        </td>
                                        <td class="p-3">
                                            <p>081247214241</p>
                                        </td>
                                        <td class="p-3">
                                            <p>10 Hektar</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Varietas A</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Pupuk A</p>
                                        </td>
                                        <td class="p-3">
                                            <p>> 10 bulan</p>
                                        </td>
                                        <td class="p-3 text-right">
                                            <div class="flex item-center justify-center">
                                                <div onclick="document.getElementById('modalUbah').showModal()" class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer">
                                                    <i class='bx bxs-pencil' title="Ubah"></i>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110 cursor-pointer" data-modal-toggle="authentication-modal">
                                                    <i class='bx bxs-trash' title="Hapus"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Ubah Data Petani -->
                                    @include('supplier.pages.petani.edit_petani')

                                    <!-- Hapus Data Petani -->
                                    @include('supplier.pages.petani.delete_petani')

                                    <!-- dua -->
                                    <tr class="border-b border-opacity-20 border-gray-700 bg-white">
                                        <td class="p-3">
                                            <p>2.</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Udin</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Jl. Ahmad Yani</p>
                                        </td>
                                        <td class="p-3">
                                            <p>081247214241</p>
                                        </td>
                                        <td class="p-3">
                                            <p>20 Hektar</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Varietas B</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Pupuk B</p>
                                        </td>
                                        <td class="p-3">
                                            <p>
                                                < 10 bulan</p>
                                        </td>
                                        <td class="p-3 text-right">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <i class='bx bxs-pencil' title="Ubah"></i>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <i class='bx bxs-trash' title="Hapus"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- tiga -->
                                    <tr class="border-b border-opacity-20 border-gray-700 bg-white">
                                        <td class="p-3">
                                            <p>3.</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Adi</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Jl. Tanjung Pura</p>
                                        </td>
                                        <td class="p-3">
                                            <p>081247214241</p>
                                        </td>
                                        <td class="p-3">
                                            <p>30 Hektar</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Varietas C</p>
                                        </td>
                                        <td class="p-3">
                                            <p>Pupuk C</p>
                                        </td>
                                        <td class="p-3">
                                            <p>> 10 bulan</p>
                                        </td>
                                        <td class="p-3 text-right">
                                            <div class="flex item-center justify-center">
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <i class='bx bxs-pencil' title="Ubah"></i>
                                                </div>
                                                <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                    <i class='bx bxs-trash' title="Hapus"></i>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <!-- script animasi tombol tambah data dan ubah data -->
            <style>
                dialog::backdrop {
                    background: linear-gradient(45deg, rgba(0, 0, 0, 0.5), rgba(54, 54, 54, 0.5));
                    backdrop-filter: blur(3px);
                }


                @keyframes appear {
                    from {
                        opacity: 0;
                        transform: translateX(-3rem);
                    }

                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
            </style>

            <!-- script animasi tombol hapus data -->
            <script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>

        </div>
    </div>
</div>
@endsection