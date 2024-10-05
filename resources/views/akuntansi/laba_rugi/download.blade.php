<?php $total_pendapatan = collect([]);
$total_beban = collect([]); ?>
@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    <p class="mt-5 uppercase text-sm font-bold tracking-tight antialiased">{{ $title }}</p>
    <p class="uppercase text-sm font-bold tracking-tight antialiased">per.
        {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
        {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>
    {{-- FIXME: pdf size auto adjusted with omnitor size --}}
    {{-- TODO: tambahkan total di bawah --}}
    {{-- SECTION Tabel Pendapatan --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-base font-bold leading-4 tracking-wide text-left text-gray-800 uppercase border-b border-gray-200">
                                Pendapatan Penjualan
                            </th>
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($pendapatan as $pendapatan)
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $pendapatan->id)->isEmpty() && $transaksi->where('kredit', $pendapatan->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            {{-- Nama Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        {{ $pendapatan->nama }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Nama Rekening --}}

                            @foreach ($transaksi as $transaksis)
                                {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                @if (!($transaksis->debit == $pendapatan->id || $transaksis->kredit == $pendapatan->id))
                                    @continue
                                @endif
                                {{-- ========================================================= --}}
                                {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                @if ($transaksis->debit == $pendapatan->id && $transaksis->kredit == $pendapatan->id)
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                KREDIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                @else
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $pendapatan->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                @if ($transaksis->debit == $pendapatan->id)
                                                    DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                @else
                                                    KREDIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                @endif
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Baris Total per Rekening --}}
                            <tr class="border-gray-400">
                                <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        Total {{ $pendapatan->nama }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        {{-- {{ dd($transaksi->where('kredit', $pendapatan->id)->sum('nominal')) }} --}}
                                        <?php $total_pendapatan_awal = $transaksi->where('kredit', $pendapatan->id)->sum('nominal') - $transaksi->where('debit', $pendapatan->id)->sum('nominal');
                                        $total_pendapatan->push($total_pendapatan_awal); ?>
                                        {{ Number::currency($total_pendapatan_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black invisible">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Pendapatan --}}
                        <tr class="bg-zinc-200 border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    Total Pendapatan Penjualan
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ Number::currency($total_pendapatan->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Pendapatan --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Pendapatan --}}
    <br>
    {{-- SECTION Tabel Beban --}}
    <div class="mt-5">
        <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}
            <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead>
                        <tr>
                            <th colspan="3"
                                class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Beban
                            </th>
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white text-justify">
                        @foreach ($beban as $beban)
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $beban->id)->isEmpty() && $transaksi->where('kredit', $beban->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            {{-- Nama Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        {{ $beban->nama }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Nama Rekening --}}
                            @foreach ($transaksi as $transaksis)
                                {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                @if (!($transaksis->debit == $beban->id || $transaksis->kredit == $beban->id))
                                    @continue
                                @endif
                                {{-- ========================================================= --}}
                                @if ($transaksis->debit == $beban->id && $transaksis->kredit == $beban->id)
                                    {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                    {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                KREDIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                @else
                                    {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $beban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
                                                @if ($transaksis->debit == $beban->id && $transaksis->kredit != $beban->id)
                                                    DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                @else
                                                    KREDIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                @endif
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Baris Total per Rekening --}}
                            <tr class="border-gray-400">
                                <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        Total {{ $beban->nama }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        <?php $total_beban_awal = $transaksi->where('debit', $beban->id)->sum('nominal') - $transaksi->where('kredit', $beban->id)->sum('nominal');
                                        $total_beban->push($total_beban_awal); ?>
                                        {{ Number::currency($total_beban_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black invisible">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Beban --}}
                        <tr class="bg-zinc-200 border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    Total Beban
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ Number::currency($total_beban->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Beban --}}
                        <tr>
                            <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black invisible">
                                    / Baris kosong \
                                </div>
                            </td>
                        </tr>
                        {{-- Baris Total Laba Rugi --}}
                        <tr class="bg-zinc-200 border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    Laba Rugi
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ Number::currency($total_pendapatan->sum() - $total_beban->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Laba Rugi --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Beban --}}
@endsection
