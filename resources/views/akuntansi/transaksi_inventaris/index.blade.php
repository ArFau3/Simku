@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    {{-- {{ dd($transaksi) }} --}}
    <div class="md:flex justify-between">
        <div class="md:flex">
            {{-- SECTION Tambah Transaksi if halaman transaksi --}}
            @if ($title === 'Transaksi')
                <a href="transaksi/tambah">
                    <button
                        class="bg-amber-400 opacity-85 rounded-sm p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Tambah
                        Transaksi</button>
                </a>
            @endif
            {{-- END SECTION Tambah Transaksi if halaman transaksi --}}
            {{-- <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">

                <input id="awal" type="date" class="h-10 md:mx-1 mt-1 form-input block w-full p-1 focus:bg-white"
                    id="my-textfield" name="awal" value="{{ request('awal') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="akhir" type="date" class="h-10 mt-1 md:mx-1 form-input block w-full p-1 focus:bg-white"
                    id="my-textfield" name="akhir" value="{{ request('akhir') }}">

                <div>
                    <button class="bg-amber-400 rounded-sm opacity-85 p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Cari</button>
                </div>
            </form> --}}
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5 ">
                <div class="border border-zinc-300 mx-1 md:flex">
                    <input id="awal" type="date" class="form-input border-0 block w-full p-1 focus:bg-white"
                        id="my-textfield" name="awal" value="{{ request('awal') }}">

                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-12 h-7 md:h-12 mx-auto">
                        <path fill-rule="evenodd"
                            d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>

                    <input id="akhir" type="date" class=" border-0   form-input block w-full p-1 focus:bg-white"
                        id="my-textfield" name="akhir" value="{{ request('akhir') }}">
                </div>
                <div>
                    <button class="bg-amber-400 rounded-sm opacity-85 p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Cari</button>
                </div>
            </form>
            @if (request('awal'))
                <a href="{{ strtolower($title) }}" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
        </div>
        <div class="sm:flex">
            <a href="transaksi/download">
                <button
                    class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
            </a>
            <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                <form action="" class="flex justify-between">
                    <input type="text"
                        class="border-0 bg-zinc-50 w-full sm:w-56 font-medium text-sm lg:text-sm focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                        name="cari" id="cari" placeholder="Keterangan/Jenis/Rekening Transaksi"
                        value="{{ request('cari') }}">
                    <button>
                        <i class="self-center fa fa-search text-gray-400" type="submit"></i>
                    </button>
                </form>
            </div>
            @if (request('cari'))
                <a href="{{ strtolower($title) }}" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
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
                                class="w-20 sm:w-16 pl-4 pr-2 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Nomor</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Tanggal</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                @if ($title === 'Transaksi')
                                    Jenis Transaksi
                                @endif
                                @if ($title === 'Aset Tetap')
                                    Nama Rekening
                                @endif
                            </th>
                            <th
                                class="w-32 sm:w-36 px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Debit - Kredit</th>
                            <th
                                class="px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Keterangan</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Total</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-4 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
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
                                    class="font-medium pl-4 pr-2 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $u }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y') }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    @if ($title === 'Transaksi')
                                        {{ $transaksi[$i]->jenisTransaksi->jenis }}
                                    @endif
                                    @if ($title === 'Aset Tetap')
                                        @if (true)
                                            Nama Rekening
                                        @endif
                                    @endif
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $transaksi[$i]->rekeningDebit->nama }} - {{ $transaksi[$i]->rekeningKredit->nama }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $transaksi[$i]->keterangan }}
                                </td>
                                <td class="px-4 sm:px-4 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        {{ Number::currency($transaksi[$i]->nominal, 'IDR', 'id') }}
                                    </div>
                                </td>
                                <td
                                    class="px-4 sm:px-4 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                    <a href="transaksi/{{ $transaksi[$i]->id }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="/transaksi/hapus/{{ $transaksi[$i]->id }}" method="POST" class="inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900"
                                            onclick="return confirm('Anda akan Menghapus Transaksi &quot;{{ $transaksi[$i]->keterangan }}&quot; yang terjadi di tanggal {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->isoFormat('D MMMM Y') }}')">Hapus</button>
                                    </form>
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
