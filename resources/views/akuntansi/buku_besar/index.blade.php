@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        <div class="md:flex">
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
        </div>
        <a href="transaksi/download">
            <button
                class="bg-amber-400 opacity-80 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
        </a>
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabels --}}
    @foreach ($rekening as $rekening)
        <p class="px-4 sm:px-6 py-1 text-lg font-bold leading-4 tracking-wide text-left text-gray-500 uppercase">
            {{ $rekening->nama }}
        </p>
        {{-- SECTION Tabel Data --}}
        <div class="flex flex-col mt-1 mb-10">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
                <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                    <table class="min-w-full">
                        {{-- SECTION Header Tabel --}}
                        <thead class="bg-zinc-200">
                            <tr>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                    Tanggal</th>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                    Nomor Rekening
                                </th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                    Nama Rekening</th>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                    Debit</th>
                                <th
                                    class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                    Kredit</th>
                            </tr>
                        </thead>
                        {{-- END SECTION Header Tabel --}}
                        {{-- SECTION Body Tabel --}}
                        <tbody class="bg-white">
                            @foreach ($transaksi->where('debit', $rekening->id) as $debit)
                                <tr>
                                    {{-- Kolom Tanggal --}}

                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ \Carbon\Carbon::parse($debit->tanggal)->format('d/m/Y') }}
                                    </td>

                                    {{-- END Kolom Tanggal --}}
                                    {{-- Baris Debit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nama }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            {{ Number::currency($debit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            -
                                        </div>
                                    </td>
                                    {{-- END Baris Debit --}}
                                </tr>
                            @endforeach
                            @foreach ($transaksi->where('kredit', $rekening->id) as $kredit)
                                <tr>
                                    {{-- Kolom Tanggal --}}

                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ \Carbon\Carbon::parse($kredit->tanggal)->format('d/m/Y') }}
                                    </td>

                                    {{-- END Kolom Tanggal --}}
                                    {{-- Baris kredit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nama }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            -
                                        </div>
                                    </td>
                                    <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            {{ Number::currency($kredit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    {{-- END Baris Kredit --}}
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- END SECTION Body Tabel --}}
                    </table>
                </div>
            </div>
        </div>
        {{-- END SECTION Tabel Data --}}
    @endforeach
    {{-- END SECTION Tabels --}}
@endsection
