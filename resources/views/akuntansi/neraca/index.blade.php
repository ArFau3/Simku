<?php $total_aset = collect([]);
$total_kewajiban = collect([]);
$total_modal = collect([]); ?>
@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Form Tanggal --}}
        <div class="md:flex">
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5 my-auto">
                <input id="awal" type="date" class="h-10 md:mx-1 mt-1 form-input block w-full focus:bg-white"
                    id="my-textfield" name="awal" value="{{ request('awal') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="akhir" type="date" class="h-10 mt-1 md:mx-1 form-input block w-full focus:bg-white"
                    id="my-textfield" name="akhir" value="{{ request('akhir') }}">

                <div>
                    <button class="bg-amber-400 opacity-85 rounded-sm p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Oke</button>
                </div>
            </form>
            @if (request('awal') != $user->koperasi->berdiri || request('akhir') != $tutup_buku)
                <a href="/neraca?awal={{ $user->koperasi->berdiri }}&akhir={{ $tutup_buku }}" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased">
                    </button>
                </a>
            @endif
            {{-- Bandingkan Tahun --}}
            <form action="" id="bandingkan" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
                <div class="md:flex my-auto">

                    <div class=" md:float-right">
                        <select name="periode" class="h-10 mt-1 md:mx-1 form-select block w-full focus:bg-white"
                            id="my-select" onchange='DoSubmit("bandingkan");'>
                            <option value="" disabled selected hidden>Bandingkan</option>
                            <?php $year = \Carbon\Carbon::now()->year; ?>
                            @for ($i = 1; $i < 5; $i++)
                                <option value="{{ $year - $i }}">
                                    {{ $i . ' Periode' }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
            </form>
            @if (request('periode'))
                <a href="/neraca" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
            {{-- FIXME: gabunfkan filter dan bandingkan --}}
            {{-- END Bandingkan Tahun --}}
            {{-- FIXME: rapikan komentar form tanggal dan bandingkan --}}
        </div>
        {{-- END Form Tanggal --}}

        {{-- FIXME: total debit kredit masih blm seimbang padahal sudah tutup buku --}}
        @if (request('awal'))
            <form action="neraca/download" class="my-1">
                <input type="hidden" name="awal" value="{{ request('awal') }}">
                <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                <button
                    class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
            </form>
        @else
            <a href="neraca/download">
                <button
                    class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
            </a>
        @endif
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Tabel Aset --}}
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-base font-bold leading-4 tracking-wide text-left text-gray-800 uppercase border-b border-gray-200">
                                Aktiva
                            </th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- FIXME: di modal tambahkan laba rugi tanpa nomor, untuk menyamakan sisi, jika sudah tutup buku baru dipindahkan ke rekening modal yg benar --}}
                    <tbody class="bg-white">
                        @foreach ($aset as $aset)
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $aset->id)->isEmpty() && $transaksi->where('kredit', $aset->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        {{ $aset->nama }}
                                    </div>
                                </td>
                            </tr>
                            @foreach ($transaksi as $transaksis)
                                {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                @if (!($transaksis->debit == $aset->id || $transaksis->kredit == $aset->id))
                                    @continue
                                @endif
                                {{-- ========================================================= --}}
                                {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                @if ($transaksis->debit == $aset->id && $transaksis->kredit == $aset->id)
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                @if ($transaksis->debit == $aset->id)
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
                                <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        Total {{ $aset->nama }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        <?php $total_aset_awal = $transaksi->where('debit', $aset->id)->sum('nominal') - $transaksi->where('kredit', $aset->id)->sum('nominal');
                                        $total_aset->push($total_aset_awal); ?>
                                        {{ Number::currency($total_aset_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-2 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="invisible text-sm leading-5 text-gray-800 font-bold">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Aset --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Aset
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-800 font-bold">
                                    {{ Number::currency($total_aset->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Aset --}}
                    </tbody>
                    {{-- END SECTION Body Tabel --}}
                    {{-- END SECTION Tabel Aset --}}
                    {{-- SECTION Tabel Kewajiban & Modal --}}
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-base font-bold leading-4 tracking-wide text-left text-gray-800 uppercase border-b border-gray-200">
                                Pasiva
                            </th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    <tbody class="bg-white">
                        {{-- SECTION Tabel Kewajiban --}}
                        @foreach ($kewajiban as $kewajiban)
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $kewajiban->id)->isEmpty() && $transaksi->where('kredit', $kewajiban->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        {{ $kewajiban->nama }}
                                    </div>
                                </td>
                            </tr>
                            @foreach ($transaksi as $transaksis)
                                {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                @if (!($transaksis->debit == $kewajiban->id || $transaksis->kredit == $kewajiban->id))
                                    @continue
                                @endif
                                {{-- ========================================================= --}}
                                {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                @if ($transaksis->debit == $kewajiban->id && $transaksis->kredit == $kewajiban->id)
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                @if ($transaksis->debit == $kewajiban->id)
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
                                <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        Total {{ $kewajiban->nama }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        <?php $total_kewajiban_awal = $transaksi->where('kredit', $kewajiban->id)->sum('nominal') - $transaksi->where('debit', $kewajiban->id)->sum('nominal');
                                        $total_kewajiban->push($total_kewajiban_awal); ?>
                                        {{ Number::currency($total_kewajiban_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-2 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="invisible text-sm leading-5 text-gray-800 font-bold">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total kewajiban --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Kewajiban
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-800 font-bold">
                                    {{ Number::currency($total_kewajiban->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Kewajiban --}}
                        {{-- END SECTION Tabel Kewajiban --}}
                        {{-- SECTION Tabel Ekuitas --}}
                        @foreach ($modal as $modal)
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $modal->id)->isEmpty() && $transaksi->where('kredit', $modal->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        {{ $modal->nama }}
                                    </div>
                                </td>
                            </tr>
                            @foreach ($transaksi as $transaksis)
                                {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                @if (!($transaksis->debit == $modal->id || $transaksis->kredit == $modal->id))
                                    @continue
                                @endif
                                {{-- ========================================================= --}}
                                {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                @if ($transaksis->debit == $modal->id && $transaksis->kredit == $modal->id)
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                DEBIT {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                            </div>
                                        </td>
                                        {{-- END Baris Debit --}}
                                    </tr>
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
                                                @if ($transaksis->debit == $modal->id)
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
                                <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        Total {{ $modal->nama }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-bold">
                                        <?php $total_modal_awal = $transaksi->where('kredit', $modal->id)->sum('nominal') - $transaksi->where('debit', $modal->id)->sum('nominal');
                                        $total_modal->push($total_modal_awal); ?>
                                        {{ Number::currency($total_modal_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3"
                                    class="font-medium px-4 sm:px-6 py-2 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    <div class="invisible text-sm leading-5 text-gray-800 font-bold">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Ekuitas --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Ekuitas
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-800 font-bold">
                                    {{ Number::currency($total_modal->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Ekuitas --}}
                        {{-- END SECTION Tabel Ekuitas --}}
                        {{-- Baris Total Kewajiban & Ekuitas --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Kewajiban & Ekuitas
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-800 font-bold">
                                    {{ Number::currency($total_kewajiban->sum() + $total_modal->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Kewajiban & Modal --}}
                    </tbody>
                    {{-- END SECTION Tabel Kewajiban & Modal --}}
                </table>
            </div>
        </div>
    </div>
@endsection
