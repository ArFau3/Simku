<?php $total_aset = collect([]);
$total_kewajiban = collect([]);
$total_modal = collect([]); ?>
@extends('akuntansi.layouts.download')
{{-- FIXME: halaman kedua header yg terulang aktiva dan pasiva, padahal harusnya hanya aktiva, page 3 anehnya benar --}}
{{-- kemungkinana keran beda dengan laba rugi yg dipisah menjadi 2 tabel, ini digabung dan dipisah lewat css column --}}
@section('content')
    <p class="mt-5 uppercase text-sm font-bold tracking-tight antialiased">{{ $title }}</p>
    <p class="uppercase text-sm font-bold tracking-tight antialiased">per.
        {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
        {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>
    {{-- FIXME: pdf size auto adjusted with omnitor size --}}
    {{-- TODO: tambahkan total di bawah --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Tabel Aset --}}
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th colspan="3"
                                class="px-4 text-base font-bold leading-4 tracking-wider text-left text-black uppercase">
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
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $aset->id)
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
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $aset->id)
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
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $aset->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        Total {{ $aset->nama }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        <?php $total_aset_awal = $transaksi->where('debit', $aset->id)->sum('nominal') - $transaksi->where('kredit', $aset->id)->sum('nominal');
                                        $total_aset->push($total_aset_awal); ?>
                                        {{ Number::currency($total_aset_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="invisible class="py-1 px-2 text-sm leading-5 text-black"">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Aset --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Aset
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
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
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $kewajiban->id)
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
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $kewajiban->id)
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
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $kewajiban->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        Total {{ $kewajiban->nama }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        <?php $total_kewajiban_awal = $transaksi->where('kredit', $kewajiban->id)->sum('nominal') - $transaksi->where('debit', $kewajiban->id)->sum('nominal');
                                        $total_kewajiban->push($total_kewajiban_awal); ?>
                                        {{ Number::currency($total_kewajiban_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="invisible py-1 px-2 text-sm leading-5 text-black">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total kewajiban --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Kewajiban
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
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
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $modal->id)
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
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $modal->id)
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
                                    <tr>
                                        {{-- Baris Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nomor }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nomor }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            @if ($transaksis->debit == $modal->id)
                                                {{ $transaksis->rekeningDebit->nama }}
                                            @else
                                                {{ $transaksis->rekeningKredit->nama }}
                                            @endif
                                        </td>
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="py-1 px-2 text-sm leading-5 text-black">
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
                                <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        Total {{ $modal->nama }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="py-1 px-2 text-sm leading-5 text-black">
                                        <?php $total_modal_awal = $transaksi->where('kredit', $modal->id)->sum('nominal') - $transaksi->where('debit', $modal->id)->sum('nominal');
                                        $total_modal->push($total_modal_awal); ?>
                                        {{ Number::currency($total_modal_awal, 'IDR', 'id') }}
                                    </div>
                                </td>
                            </tr>
                            {{-- END Baris Total per Rekening --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="invisible py-1 px-2 text-sm leading-5 text-black">
                                        / Baris kosong \
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- Baris Total Ekuitas --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Total Ekuitas
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="text-base underline leading-5 text-gray-800 font-bold">
                                    {{ Number::currency($total_modal->sum(), 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Ekuitas --}}
                        {{-- END SECTION Tabel Ekuitas --}}
                        {{-- Baris Total Kewajiban & Ekuitas --}}
                        <tr class="border-gray-400">
                            <td colspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                <div class="text-base leading-5 text-gray-800 font-bold">
                                    Kewajiban & Ekuitas
                                </div>
                            </td>
                            <td class="py-1 px-2 text-sm leading-5 text-black">
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
