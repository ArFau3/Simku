@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        <div class="md:flex">
            {{-- SECTION Tambah Transaksi if halaman transaksi --}}
            @if ($title === 'Transaksi')
                <a href="transaksi/tambah">
                    <button
                        class="bg-amber-400 opacity-80 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Tambah
                        Transaksi</button>
                </a>
            @endif
            {{-- END SECTION Tambah Transaksi if halaman transaksi --}}
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">

                <input id="date" type="date" class="h-10 md:mx-1 mt-1 form-input block w-full focus:bg-white"
                    id="my-textfield">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="date" type="date" class="h-10 mt-1 md:mx-1 form-input block w-full focus:bg-white"
                    id="my-textfield">

                <div>
                    <a href="transaksi/cari">
                        <button
                            class="bg-amber-400 opacity-80 p-2 mt-1 font-medium text-sm lg:text-base antialiased">Oke</button>
                    </a>
                </div>
            </form>

            <a href="transaksi/download">
                <button
                    class="bg-amber-400 opacity-80 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
            </a>
        </div>
        <div class="flex rounded w-32 sm:w-60 justify-between border px-3 my-1 antialiased">
            <input type="text"
                class="border-0 bg-zinc-50 w-20 sm:w-48 font-medium text-sm lg:text-base focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                name="cari" id="cari" placeholder="Cari">
            <button>
                <i class="self-center fa fa-search text-gray-400"></i>
            </button>
        </div>
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabel Data --}}
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Nomor</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Tanggal</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                @if ($title === 'Transaksi')
                                    Jenis Transaksi
                                @endif
                                @if ($title === 'Inventaris')
                                    Nama Rekening
                                @endif
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Keterangan</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Total</th>
                            <th
                                class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Aksi</th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @for ($i = 0; $i < $transaksi->count(); $i++)
                            <?php $u = $i + 1; ?>
                            <tr>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $u }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y') }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y') }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $transaksi[$i]->keterangan }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{ Number::currency($transaksi[$i]->nominal, 'IDR', 'id') }}
                                    </div>
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
@endsection
