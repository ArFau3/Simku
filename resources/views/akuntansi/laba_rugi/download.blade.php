<?php $total_pendapatan = [];
$total_beban = []; ?>

@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    {{-- SECTION Tabel Pendapatan --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Tabel Pendapatan --}}
                    {{-- Header Tabel --}}
                    <tr class="bg-zinc-200">
                        <th colspan="{{ request('periode') ? '2' : '3' }}"
                            class="w-20 px-4 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Pendapatan Penjualan
                        </th>
                        @if (request('periode'))
                            @for ($i = (int) $year - (int) request('periode') + 1; $i > 0; $i--)
                                <th
                                    class="w-20 px-4 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                                    {{ request('periode') + $i - 1 }}
                                </th>
                            @endfor
                        @endif
                    </tr>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($pendapatan as $pendapatan)
                            {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                            <?php $per_rekening = collect([]);
                            $sisi_debit = 0;
                            $sisi_kredit = 0; ?>
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $pendapatan->id)->isEmpty() && $transaksi->where('kredit', $pendapatan->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-download.normal-td :value="$pendapatan->nomor" />
                                <x-download.normal-td :value="$pendapatan->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                @foreach ($transaksi as $transaksis)
                                    {{-- filterisasi transaksi sesuai rekening --}}
                                    @if ($transaksis->debit == $pendapatan->id || $transaksis->kredit == $pendapatan->id)
                                        <?php $per_rekening->push($transaksis); ?>
                                    @endif
                                @endforeach
                                {{-- {{ dd($per_rekening) }} --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                @if (request('periode'))
                                    @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                        <?php $sisi_debit =
                                            $per_rekening
                                                ->where('debit', $pendapatan->id)
                                                ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                                ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                                ->sum('nominal') * -1;
                                        $sisi_kredit = $per_rekening
                                            ->where('kredit', $pendapatan->id)
                                            ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                            ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                            ->sum('nominal'); ?>


                                        @if (array_key_exists(request('periode') + $j - 1, $total_pendapatan))
                                            <?php $total_pendapatan[request('periode') + $j - 1][] = $sisi_debit + $sisi_kredit; ?>
                                        @else
                                            <?php $total_pendapatan[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        @endif
                                        {{-- {{ Number::currency($total_per_bulan, 'IDR', 'id') }} --}}
                                        <x-download.nominal-td :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $pendapatan->id)->sum('nominal') * -1;
                                    $sisi_kredit = $per_rekening->where('kredit', $pendapatan->id)->sum('nominal');
                                    $total_pendapatan[] = $sisi_debit + $sisi_kredit; ?>
                                    <x-download.nominal-td :value="$sisi_debit + $sisi_kredit" />
                                @endif
                            </tr>
                        @endforeach
                        {{-- Baris Total Pendapatan --}}
                        <tr class="border-gray-400">
                            <x-download.total-nominal :value="__('Total Pendapatan Penjualan')" :cols="__('2')" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_pendapatan))
                                        <x-download.nominal :value="array_sum($total_pendapatan[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_pendapatan[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-download.nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_pendapatan)
                                    <x-download.nominal :value="array_sum($total_pendapatan)" />
                                @else
                                    <?php $total_pendapatan[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-download.nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Pendapatan --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                    {{-- END SECTION Tabel Pendapatan --}}
                    <tr>
                        <td colspan="{{ request('periode') ? 2 + (int) $year - (int) request('periode') + 1 : '3' }}"
                            class="w-20 px-4 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            <p class="invisible">/ Baris kosong \</p>
                        </td>
                    </tr>
                    {{-- SECTION Tabel Beban --}}
                    {{-- Header Tabel --}}
                    <tr class="bg-zinc-200">
                        <th colspan="{{ request('periode') ? '2' : '3' }}"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Beban
                        </th>
                        @if (request('periode'))
                            @for ($i = (int) $year - (int) request('periode') + 1; $i > 0; $i--)
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                                    {{ request('periode') + $i - 1 }}
                                </th>
                            @endfor
                        @endif
                    </tr>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($beban as $beban)
                            {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                            <?php $per_rekening = collect([]);
                            $sisi_debit = 0;
                            $sisi_kredit = 0; ?>
                            {{-- ==================================================================== --}}
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $beban->id)->isEmpty() && $transaksi->where('kredit', $beban->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-download.normal-td :value="$beban->nomor" />
                                <x-download.normal-td :value="$beban->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                @foreach ($transaksi as $transaksis)
                                    {{-- filterisasi transaksi sesuai rekening --}}
                                    @if ($transaksis->debit == $beban->id || $transaksis->kredit == $beban->id)
                                        <?php $per_rekening->push($transaksis); ?>
                                    @endif
                                @endforeach
                                {{-- {{ dd($per_rekening) }} --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                @if (request('periode'))
                                    @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                        <?php $sisi_debit = $per_rekening
                                            ->where('debit', $beban->id)
                                            ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                            ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                            ->sum('nominal');
                                        $sisi_kredit =
                                            $per_rekening
                                                ->where('kredit', $beban->id)
                                                ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                                ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                                ->sum('nominal') * -1; ?>

                                        @if (array_key_exists(request('periode') + $j - 1, $total_beban))
                                            <?php $total_beban[request('periode') + $j - 1][] = $sisi_debit + $sisi_kredit; ?>
                                        @else
                                            <?php $total_beban[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        @endif
                                        <x-download.nominal-td :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $beban->id)->sum('nominal');
                                    $sisi_kredit = $per_rekening->where('kredit', $beban->id)->sum('nominal') * -1;
                                    $total_beban[] = $sisi_debit + $sisi_kredit; ?>

                                    <x-download.nominal-td :value="$sisi_debit + $sisi_kredit" />
                                @endif

                            </tr>
                        @endforeach
                        {{-- Baris Total Beban --}}
                        <tr class="border-gray-400">
                            <x-download.total-nominal :value="__('Total Beban')" :cols="__('2')" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_beban))
                                        <x-download.nominal :value="array_sum($total_beban[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_beban[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-download.nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_beban)
                                    <x-download.nominal :value="array_sum($total_beban)" />
                                @else
                                    <?php $total_beban[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-download.nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                    </tbody>
                    {{-- END Baris Total Beban --}}
                    {{-- END SECTION Tabel Beban --}}
                    {{-- Baris Total Laba Rugi --}}
                    <tr class="bg-zinc-200 border-gray-400">
                        <x-download.total-nominal :value="__('Laba Rugi')" :cols="__('2')" />
                        @if (request('periode'))
                            {{-- {{ dd($total_aset) }} --}}
                            @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                {{-- FIXME: JIKA TIDAK ADA pendapatan TAPI ADA beban bakal error --}}
                                @if ($total_pendapatan)
                                    <x-download.nominal :value="array_sum($total_pendapatan[request('periode') + $j - 1]) -
                                        array_sum($total_beban[request('periode') + $j - 1])" />
                                @else
                                    <x-download.nominal :value="0" />
                                @endif
                            @endfor
                        @else
                            @if ($total_pendapatan)
                                <x-download.nominal :value="array_sum($total_pendapatan) - array_sum($total_beban)" />
                            @else
                                <x-download.nominal :value="0" />
                            @endif
                        @endif
                    </tr>
                    {{-- END Baris Total Laba Rugi --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Pendapatan --}}
@endsection
