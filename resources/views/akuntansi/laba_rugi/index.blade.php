<?php $total_pendapatan = [];
$total_beban = []; ?>

@extends('akuntansi.layouts.layout')
@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Sisi Kiri --}}
        <div class="md:flex">
            {{-- Form Tanggal --}}
            {{-- Form --}}
            <form action="" class="md:flex mx-1 md:mb-0 mb-5">
                <x-filter.tanggal />
            </form>
            {{-- END Form --}}
            {{-- Cancel Button --}}
            @if (
                (request('awal') != $tutup_buku || request('akhir') != \Carbon\Carbon::now()->toDateString()) &&
                    !request('periode'))
                <a href="/laba-rugi" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- END Cancel Button --}}
            {{-- END Form Tanggal --}}
            {{-- Form Bandingkan Tahun --}}
            <x-filter.bandingkan :year="$year" />
            @if (request('periode'))
                <a href="/laba-rugi" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- END Form Bandingkan Tahun --}}
        </div>
        {{-- END Sisi Kiri --}}
        {{-- Sisi Kanan --}}
        @if (request('awal'))
            <form action="laba-rugi/download">
                <input type="hidden" name="awal" value="{{ request('awal') }}">
                <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                <x-button.download />
            </form>
        @else
            {{-- TODO: jika pakai filter bandingkan download link siapkan juga --}}
            <a href="laba-rugi/download">
                <x-button.download />
            </a>
        @endif
        {{-- END Sisi Kanan --}}
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabel Pendapatan --}}
    <div class="flex flex-col mt-1 mb-0">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- Header Tabel --}}
                    <tr class="bg-zinc-200">
                        <th colspan="{{ request('periode') ? '2' : '3' }}"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Pendapatan Penjualan
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
                                <x-tabel.td :value="$pendapatan->nomor" />
                                <x-tabel.td :value="$pendapatan->nama" />
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
                                        <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $pendapatan->id)->sum('nominal') * -1;
                                    $sisi_kredit = $per_rekening->where('kredit', $pendapatan->id)->sum('nominal');
                                    $total_pendapatan[] = $sisi_debit + $sisi_kredit; ?>
                                    <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                @endif
                            </tr>
                        @endforeach
                        {{-- Baris Total Pendapatan --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Pendapatan Penjualan')" :cols="__('2')" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_pendapatan))
                                        <x-tabel.total-nominal :value="array_sum($total_pendapatan[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_pendapatan[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_pendapatan)
                                    <x-tabel.total-nominal :value="array_sum($total_pendapatan)" />
                                @else
                                    <?php $total_pendapatan[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Pendapatan --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                    {{-- END SECTION Tabel Pendapatan --}}
                    <tr>
                        <td colspan="3"
                            class="text-left invisible font-medium px-4 sm:px-6 py-2 text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
                            / Baris kosong \
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
                                <x-tabel.td :value="$beban->nomor" />
                                <x-tabel.td :value="$beban->nama" />
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
                                        <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $beban->id)->sum('nominal');
                                    $sisi_kredit = $per_rekening->where('kredit', $beban->id)->sum('nominal') * -1;
                                    $total_beban[] = $sisi_debit + $sisi_kredit; ?>

                                    <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                @endif

                            </tr>
                        @endforeach
                        {{-- Baris Total Beban --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Beban')" :cols="__('2')" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_beban))
                                        <x-tabel.total-nominal :value="array_sum($total_beban[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_beban[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_beban)
                                    <x-tabel.total-nominal :value="array_sum($total_beban)" />
                                @else
                                    <?php $total_beban[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                    </tbody>
                    {{-- END Baris Total Beban --}}
                    {{-- END SECTION Tabel Beban --}}
                    {{-- Baris Total Laba Rugi --}}
                    <tr class="bg-zinc-200 border-gray-400">
                        <x-tabel.total-col :value="__('Laba Rugi')" :cols="__('2')" />
                        @if (request('periode'))
                            {{-- {{ dd($total_aset) }} --}}
                            @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                {{-- FIXME: JIKA TIDAK ADA pendapatan TAPI ADA beban bakal error --}}
                                @if ($total_pendapatan)
                                    <x-tabel.total-nominal :value="array_sum($total_pendapatan[request('periode') + $j - 1]) -
                                        array_sum($total_beban[request('periode') + $j - 1])" />
                                @else
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endfor
                        @else
                            @if ($total_pendapatan)
                                <x-tabel.total-nominal :value="array_sum($total_pendapatan) - array_sum($total_beban)" />
                            @else
                                <x-tabel.total-nominal :value="0" />
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
@endsection
