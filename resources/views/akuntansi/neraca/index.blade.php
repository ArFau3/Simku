<?php $total_aset = [];
$total_kewajiban = [];
$total_modal = []; ?>
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
            @if ((request('awal') != $user->koperasi->berdiri || request('akhir') != $tutup_buku) && !request('periode'))
                <a href="/neraca?awal={{ $user->koperasi->berdiri }}&akhir={{ $tutup_buku }}" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- END Cancel Button --}}
            {{-- END Form Tanggal --}}
            {{-- Bandingkan Tahun --}}
            <x-filter.bandingkan :year="$year" />
            @if (request('periode'))
                <a href="/neraca" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- END Bandingkan Tahun --}}
        </div>
        {{-- END Sisi Kiri --}}
        @if (request('awal'))
            <form action="neraca/download">
                <input type="hidden" name="awal" value="{{ request('awal') }}">
                <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                <x-button.download />
            </form>
        @else
            <a href="neraca/download">
                <x-button.download />
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
                    <tr class="bg-zinc-200">
                        <th colspan="{{ request('periode') ? '2' : '3' }}"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Aktiva
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
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- FIXME: failsafe jika tidak ada transaksi di aset --}}
                    {{-- FIXME: di modal tambahkan laba rugi tanpa nomor, untuk menyamakan sisi, jika sudah tutup buku baru dipindahkan ke rekening modal yg benar --}}
                    <tbody class="bg-white">
                        @foreach ($aset as $aset)
                            {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                            <?php $per_rekening = collect([]);
                            $sisi_debit = 0;
                            $sisi_kredit = 0; ?>
                            {{-- =================================================================== --}}
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $aset->id)->isEmpty() && $transaksi->where('kredit', $aset->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ============================================= --}}
                            <tr>
                                <x-tabel.td :value="$aset->nomor" />
                                <x-tabel.td :value="$aset->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                {{-- filterisasi transaksi sesuai rekening --}}
                                @foreach ($transaksi as $transaksis)
                                    @if ($transaksis->debit == $aset->id || $transaksis->kredit == $aset->id)
                                        <?php $per_rekening->push($transaksis); ?>
                                    @endif
                                @endforeach
                                {{-- ==================================== --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                @if (request('periode'))
                                    @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                        <?php $sisi_debit = $per_rekening
                                            ->where('debit', $aset->id)
                                            ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                            ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                            ->sum('nominal');
                                        $sisi_kredit =
                                            $per_rekening
                                                ->where('kredit', $aset->id)
                                                ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                                ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                                ->sum('nominal') * -1; ?>

                                        @if (array_key_exists(request('periode') + $j - 1, $total_aset))
                                            <?php $total_aset[request('periode') + $j - 1][] = $sisi_debit + $sisi_kredit; ?>
                                        @else
                                            <?php $total_aset[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        @endif
                                        <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $aset->id)->sum('nominal');
                                    $sisi_kredit = $per_rekening->where('kredit', $aset->id)->sum('nominal') * -1;
                                    $total_aset[] = $sisi_debit + $sisi_kredit; ?>
                                    <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                @endif

                            </tr>
                        @endforeach
                        {{-- Baris Total Aset --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Aset')" :cols="2" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_aset))
                                        <x-tabel.total-nominal :value="array_sum($total_aset[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_aset[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_aset)
                                    <x-tabel.total-nominal :value="array_sum($total_aset)" />
                                @else
                                    <?php $total_aset[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Aset --}}
                    </tbody>
                    {{-- END SECTION Body Tabel --}}
                    {{-- END SECTION Tabel Aset --}}
                    <tr>
                        <td colspan="3"
                            class="invisible text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
                            / Baris kosong \
                        </td>
                    </tr>
                    {{-- SECTION Tabel Kewajiban & Modal --}}
                    {{-- SECTION Header Tabel --}}
                    <tr class="bg-zinc-200">
                        <th colspan="{{ request('periode') ? '2' : '3' }}"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Pasiva
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
                    {{-- END SECTION Header Tabel --}}
                    <tbody class="bg-white">
                        {{-- SECTION Tabel Kewajiban --}}
                        <tr>
                            <th colspan="2"
                                class="text-left font-bold py-2 px-4 sm:px-6  text-sm leading-tiny tracking-wide text-black uppercase whitespace-no-wrap border-b border-gray-200">
                                Kewajiban
                            </th>
                        </tr>
                        @foreach ($kewajiban as $kewajiban)
                            {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                            <?php $per_rekening = collect([]);
                            $sisi_debit = 0;
                            $sisi_kredit = 0; ?>
                            {{-- ================================================================== --}}
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $kewajiban->id)->isEmpty() && $transaksi->where('kredit', $kewajiban->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-tabel.td :value="$kewajiban->nomor" />
                                <x-tabel.td :value="$kewajiban->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                {{-- filterisasi transaksi sesuai rekening --}}
                                @foreach ($transaksi as $transaksis)
                                    @if ($transaksis->debit == $kewajiban->id || $transaksis->kredit == $kewajiban->id)
                                        <?php $per_rekening->push($transaksis); ?>
                                    @endif
                                @endforeach
                                {{-- ===================================== --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                @if (request('periode'))
                                    @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                        <?php $sisi_debit =
                                            $per_rekening
                                                ->where('debit', $kewajiban->id)
                                                ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                                ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                                ->sum('nominal') * -1;
                                        $sisi_kredit = $per_rekening
                                            ->where('kredit', $kewajiban->id)
                                            ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                            ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                            ->sum('nominal'); ?>


                                        @if (array_key_exists(request('periode') + $j - 1, $total_kewajiban))
                                            <?php $total_kewajiban[request('periode') + $j - 1][] = $sisi_debit + $sisi_kredit; ?>
                                        @else
                                            <?php $total_kewajiban[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        @endif

                                        <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $kewajiban->id)->sum('nominal') * -1;
                                    $sisi_kredit = $per_rekening->where('kredit', $kewajiban->id)->sum('nominal');
                                    $total_kewajiban[] = $sisi_debit + $sisi_kredit; ?>
                                    <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                @endif

                            </tr>
                        @endforeach
                        {{-- Baris Total kewajiban --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Kewajiban')" cols="2" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_kewajiban))
                                        <x-tabel.total-nominal :value="array_sum($total_kewajiban[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_kewajiban[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_kewajiban)
                                    <x-tabel.total-nominal :value="array_sum($total_kewajiban)" />
                                @else
                                    <?php $total_kewajiban[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Kewajiban --}}
                        {{-- END SECTION Tabel Kewajiban --}}
                        {{-- SECTION Tabel Ekuitas --}}
                        <tr>
                            <th colspan="2"
                                class="text-left font-bold py-2 px-4 sm:px-6  text-sm leading-tiny tracking-wide text-black uppercase whitespace-no-wrap border-b border-gray-200">
                                Modal
                            </th>
                        </tr>
                        @foreach ($modal as $modal)
                            {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                            <?php $per_rekening = collect([]);
                            $sisi_debit = 0;
                            $sisi_kredit = 0; ?>
                            {{-- =================================================================== --}}
                            {{-- lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksi->where('debit', $modal->id)->isEmpty() && $transaksi->where('kredit', $modal->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-tabel.td :value="$modal->nomor" />
                                <x-tabel.td :value="$modal->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                {{-- filterisasi transaksi sesuai rekening --}}
                                @foreach ($transaksi as $transaksis)
                                    @if ($transaksis->debit == $modal->id || $transaksis->kredit == $modal->id)
                                        <?php $per_rekening->push($transaksis); ?>
                                    @endif
                                @endforeach
                                {{-- ===================================== --}}
                                {{-- {{ dd($per_rekening) }} --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                @if (request('periode'))
                                    @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                        <?php $sisi_debit =
                                            $per_rekening
                                                ->where('debit', $modal->id)
                                                ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                                ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                                ->sum('nominal') * -1;
                                        $sisi_kredit = $per_rekening
                                            ->where('kredit', $modal->id)
                                            ->where('tanggal', '>=', request('periode') + $j - 1 . '-01-01')
                                            ->where('tanggal', '<=', request('periode') + $j - 1 . '-12-31')
                                            ->sum('nominal'); ?>

                                        @if (array_key_exists(request('periode') + $j - 1, $total_modal))
                                            <?php $total_modal[request('periode') + $j - 1][] = $sisi_debit + $sisi_kredit; ?>
                                        @else
                                            <?php $total_modal[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        @endif

                                        <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                        </td>
                                    @endfor
                                @else
                                    <?php $sisi_debit = $per_rekening->where('debit', $modal->id)->sum('nominal') * -1;
                                    $sisi_kredit = $per_rekening->where('kredit', $modal->id)->sum('nominal');
                                    $total_modal[] = $sisi_debit + $sisi_kredit; ?>
                                    <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                                @endif

                            </tr>
                        @endforeach
                        {{-- Baris Total Ekuitas --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Ekuitas')" :cols="2" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    @if (array_key_exists(request('periode') + $j - 1, $total_modal))
                                        <x-tabel.total-nominal :value="array_sum($total_modal[request('periode') + $j - 1])" />
                                    @else
                                        <?php $total_modal[request('periode') + $j - 1] = [$sisi_debit + $sisi_kredit]; ?>
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_modal)
                                    <x-tabel.total-nominal :value="array_sum($total_modal)" />
                                @else
                                    <?php $total_modal[$year] = [$sisi_debit + $sisi_kredit]; ?>
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Ekuitas --}}
                        {{-- END SECTION Tabel Ekuitas --}}
                        {{-- Baris Total Kewajiban & Ekuitas --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Kewajiban & Ekuitas')" :cols="2" />
                            @if (request('periode'))
                                {{-- {{ dd($total_aset) }} --}}
                                @for ($j = (int) $year - (int) request('periode') + 1; $j > 0; $j--)
                                    {{-- fixme: JIKA TIDAK ADA KEWAJIBAN TAPI ADA MODALbakal error --}}
                                    @if ($total_kewajiban)
                                        <x-tabel.total-nominal :value="array_sum($total_kewajiban[request('periode') + $j - 1]) +
                                            array_sum($total_modal[request('periode') + $j - 1])" />
                                    @else
                                        <x-tabel.total-nominal :value="0" />
                                    @endif
                                @endfor
                            @else
                                @if ($total_kewajiban)
                                    <x-tabel.total-nominal :value="array_sum($total_kewajiban) + array_sum($total_modal)" />
                                @else
                                    <x-tabel.total-nominal :value="0" />
                                @endif
                            @endif
                        </tr>
                        {{-- END Baris Total Kewajiban & Modal --}}
                    </tbody>
                    {{-- END SECTION Tabel Kewajiban & Modal --}}
                </table>
            </div>
        </div>
    </div>
@endsection
