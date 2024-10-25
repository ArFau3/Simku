@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    {{-- FIXME: pdf size auto adjusted with omnitor size --}}
    @foreach ($rekening as $rekenings)
        {{-- lewati rekening jika tidak ada data transaksi --}}
        @if ($transaksi->where('debit', $rekenings->id)->isEmpty() && $transaksi->where('kredit', $rekenings->id)->isEmpty())
            @continue
        @endif
        {{-- ========================================= --}}
        {{-- Penampung untuk data saldo --}}
        <?php $saldo_debit = 0;
        $saldo_kredit = 0; ?>
        {{-- ========================== --}}
        {{-- SECTION Nama Rekening Tabel --}}
        <p class="mt-5 mb-2 font-bold tracking-wide text-left uppercase text-black">
            {{ $rekenings->nomor . ' | ' . $rekenings->nama }}
        </p>
        {{-- END SECTION Nama Rekening Tabel --}}
        {{-- SECTION Tabel Data --}}
        <div class="mb-7">
            <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}
                <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                    <table class="min-w-full tracking-tight leading-tight">
                        {{-- SECTION Header Tabel --}}
                        <thead class="">
                            <tr class="">
                                <x-download.thead :value="__('Tanggal')" />
                                <x-download.thead :value="__('Jenis Transaksi')" />
                                <x-download.thead :value="__('Keterangan')" />
                                <x-download.thead :value="__('Debit')" />
                                <x-download.thead :value="__('Kredit')" />
                                <x-download.thead :value="__('Saldo')" />
                            </tr>
                        </thead>
                        {{-- END SECTION Header Tabel --}}
                        {{-- Body Tabel --}}
                        <tbody class="bg-white text-justify">
                            @foreach ($transaksi as $transaksis)
                                @if ($transaksis->debit == $rekenings->id || $transaksis->kredit == $rekenings->id)
                                    <tr>
                                        {{-- Kolom Tanggal --}}
                                        <x-download.normal-td :value="\Carbon\Carbon::parse($transaksis->tanggal)->format('d/m/Y')" />
                                        {{-- END Kolom Tanggal --}}
                                        {{-- Kolom Jenis Transaksi --}}
                                        <x-download.normal-td :value="$transaksis->jenisTransaksi->jenis" />
                                        {{-- END Kolom Jenis Transaksi --}}
                                        {{-- Kolom Keterangan --}}
                                        <x-download.normal-td :value="$transaksis->keterangan" />
                                        {{-- END Kolom Keterangan --}}
                                        {{-- Kolom Debit --}}
                                        @if ($transaksis->debit == $rekenings->id)
                                            <x-download.normal-td :value="Number::currency($transaksis->nominal, 'IDR', 'id')" />
                                            <?php $saldo_debit += $transaksis->nominal; ?>
                                        @else
                                            <x-download.normal-td :value="__('-')" />
                                        @endif
                                        {{-- END Kolom Debit --}}
                                        {{-- Kolom Kredit --}}
                                        @if ($transaksis->kredit == $rekenings->id)
                                            <x-download.normal-td :value="Number::currency($transaksis->nominal, 'IDR', 'id')" />
                                            <?php $saldo_kredit += $transaksis->nominal; ?>
                                        @else
                                            <x-download.normal-td :value="__('-')" />
                                        @endif
                                        {{-- END Kolom Kredit --}}
                                        {{-- Kolom Saldo --}}
                                        {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                        <?php $saldo = $saldo_debit - $saldo_kredit; ?>
                                        @if ($saldo >= 0)
                                            <?php $data_saldo = Number::currency($saldo, 'IDR', 'id'); ?>
                                        @else
                                            <?php $data_saldo = '(' . Number::currency($saldo * -1, 'IDR', 'id') . ')'; ?>
                                        @endif

                                        <x-download.normal-td :value="$data_saldo" />
                                        {{-- END Kolom Saldo --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Kolom Total --}}
                            <tr>
                                <x-download.total-nominal :value="__('Total')" :cols="__('3')" />
                                {{-- Total Debit --}}
                                <x-download.nominal :value="$saldo_debit" />
                                {{-- END Total Debit --}}
                                {{-- Total Kredit --}}
                                <x-download.nominal :value="$saldo_kredit" />
                                {{-- END Total Kredit --}}
                                {{-- Total Saldo --}}
                                <?php $saldo = $saldo_debit - $saldo_kredit; ?>


                                <x-download.nominal :value="$saldo" />
                                {{-- END Total Saldo --}}
                            </tr>
                            {{-- END Kolom Total --}}
                        </tbody>
                        {{-- END Body Tabel --}}
                    </table>
                </div>
            </div>
        </div>
        {{-- END SECTION Tabel Data --}}
    @endforeach
@endsection
