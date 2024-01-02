<?php $total_pendapatan = collect([]);
$total_beban = collect([]); ?>
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
    {{-- SECTION Tabel Pendapatan --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-base font-bold leading-4 tracking-wide text-left text-gray-500 uppercase border-b border-gray-200">
                                Pendapatan Penjualan
                            </th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($pendapatan as $pendapatan)
                            @foreach ($transaksi->where('debit', $pendapatan->id) as $debit)
                                <tr>
                                    {{-- Baris Debit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nama }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            DEBIT {{ Number::currency($debit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    {{-- END Baris Debit --}}
                                </tr>
                            @endforeach
                            @foreach ($transaksi->where('kredit', $pendapatan->id) as $kredit)
                                <tr>
                                    {{-- Baris Kredit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nama }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            KREDIT {{ Number::currency($kredit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    {{-- END Baris Kredit --}}
                                </tr>
                            @endforeach
                            {{-- Baris Total per Rekening --}}
                            <tr class="border-gray-400">
                                <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-bold">
                                        Total {{ $pendapatan->nama }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-bold">
                                        {{-- {{ dd($transaksi->where('kredit', $pendapatan->id)->sum('nominal')) }} --}}
                                        <?php $total_pendapatan_awal = $transaksi->where('kredit', $pendapatan->id)->sum('nominal') - $transaksi->where('debit', $pendapatan->id)->sum('nominal');
                                        $total_pendapatan->push($total_pendapatan_awal); ?>
                                        {{ Number::currency($total_pendapatan_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                        @endforeach
                        {{-- Baris Total Pendaptan --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-500 font-bold">
                                    Total Pendapatan Penjualan
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($total_pendapatan->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Pendaptan --}}
                    </tbody>
                    {{-- END SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Pendapatan --}}
    {{-- SECTION Tabel Beban --}}
    <div class="flex flex-col mt-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-base font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Beban
                            </th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($beban as $beban)
                            @foreach ($transaksi->where('debit', $beban->id) as $debit)
                                <tr>
                                    {{-- Baris Debit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $debit->rekeningDebit->nama }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            DEBIT {{ Number::currency($debit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    {{-- END Baris Debit --}}
                                </tr>
                            @endforeach
                            @foreach ($transaksi->where('kredit', $beban->id) as $kredit)
                                <tr>
                                    {{-- Baris Kredit --}}
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nomor }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        {{ $kredit->rekeningKredit->nama }}
                                    </td>
                                    <td
                                        class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                        <div class="text-sm leading-5 text-gray-500 font-medium">
                                            KREDIT {{ Number::currency($kredit->nominal, 'IDR', 'id') }}
                                        </div>
                                    </td>
                                    {{-- END Baris Kredit --}}
                                </tr>
                            @endforeach
                            {{-- Baris Total per Rekening --}}
                            <tr class="border-gray-400">
                                <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-bold">
                                        Total {{ $beban->nama }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-bold">
                                        <?php $total_beban_awal = $transaksi->where('debit', $beban->id)->sum('nominal') - $transaksi->where('kredit', $beban->id)->sum('nominal');
                                        $total_beban->push($total_beban_awal); ?>
                                        {{ Number::currency($total_beban_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                        @endforeach
                        {{-- Baris Total Beban --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-500 font-bold">
                                    Total Beban
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($total_beban->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Beban --}}
                        {{-- Baris Total Laba Rugi --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-500 font-bold">
                                    Laba Rugi
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($total_pendapatan->sum() - $total_beban->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Laba Rugi --}}
                    </tbody>
                    {{-- END SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Beban --}}
@endsection
