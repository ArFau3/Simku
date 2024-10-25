<?php $total_pendapatan = [];
$total_beban = []; ?>

@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    {{-- SECTION Tabel Pendapatan --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block max-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="max-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th rowspan="2" class="py-1 px-2 text-sm leading-tight border-y-4 border-double text-black">
                                Uraian</th>
                            <th colspan="12" class="py-1 px-2 text-sm leading-tight border-y-4 border-double text-black">
                                {{ request('tahun') ? request('tahun') : $tahun }}</th>
                        </tr>
                        <tr>
                            @for ($i = 0; $i < 12; $i++)
                                <th class="py-1 px-2 text-sm leading-tight border-y-4 border-double text-black">
                                    {{ $bulans[$i] }}</th>
                            @endfor
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- FIXME: table overflow jika data penuh, tdaik bisa fixed width --}}
                    {{-- SECTION Body Tabel --}}
                    @foreach ($rekenings as $rekening)
                        {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                        <?php $per_rekening = collect([]); ?>
                        <tr>
                            <x-download.normal-td :value="$rekening->rekenings->nama" />
                            @foreach ($transaksis as $transaksi)
                                {{-- filterisasi trasaksi sesuai rekening --}}
                                @if ($transaksi->debit == $rekening->rekenings->id || $transaksi->kredit == $rekening->rekenings->id)
                                    <?php $per_rekening->push($transaksi); ?>
                                @endif
                            @endforeach
                            {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                            @for ($i = 1; $i < 13; $i++)
                                {{-- FIXME: cek rekening debit/kredit => +/- --}}
                                {{-- HACK: hardcode tanpa grouping karna tanggal digabuung hari,bulan,dan tahun --}}
                                @if ($i < 10)
                                    <?php $total_per_bulan = $per_rekening
                                        ->where('tanggal', '>=', request('tahun') . '-0' . $i . '-01')
                                        ->where('tanggal', '<=', request('tahun') . '-0' . $i . '-31')
                                        ->sum('nominal'); ?>
                                @else
                                    <?php $total_per_bulan = $per_rekening
                                        ->where('tanggal', '>=', request('tahun') . '-' . $i . '-01')
                                        ->where('tanggal', '<=', request('tahun') . '-' . $i . '-31')
                                        ->sum('nominal'); ?>
                                @endif
                                <x-download.nominal-td :value="$total_per_bulan" />
                            @endfor
                        </tr>
                    @endforeach
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Pendapatan --}}
@endsection
