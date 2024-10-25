<?php $total_pendapatan = [];
$total_beban = []; ?>
@extends('akuntansi.layouts.layout')
@section('content')
    {{-- SECTION Tabel Data --}}
    <p class="italic text-zinc-600 mb-3">
        Periode Tutup Buku: {{ \Carbon\Carbon::parse(request('awal'))->format('d M Y') }} s/d
        {{ \Carbon\Carbon::parse(request('akhir'))->format('d M Y') }}
        {{-- FIXME: tanggal bahasa indo --}}
        {{-- FIXME: refactoring, ganti ke pisah pedapatan dan beban supaya nda bergantung ke desimal --}}
    </p>
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Tabel Pendapatan --}}
                    {{-- Header Tabel --}}
                    <tr class="bg-zinc-200">
                        <th colspan="3"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Pendapatan Penjualan
                        </th>
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
                            @if ($transaksis->where('debit', $pendapatan->id)->isEmpty() && $transaksis->where('kredit', $pendapatan->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-tabel.td :value="$pendapatan->nomor" />
                                <x-tabel.td :value="$pendapatan->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                @foreach ($transaksis as $transaksi)
                                    {{-- filterisasi transaksi sesuai rekening --}}
                                    @if ($transaksi->debit == $pendapatan->id || $transaksi->kredit == $pendapatan->id)
                                        <?php $per_rekening->push($transaksi); ?>
                                    @endif
                                @endforeach
                                {{-- {{ dd($per_rekening) }} --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                <?php $sisi_debit = $per_rekening->where('debit', $pendapatan->id)->sum('nominal') * -1;
                                $sisi_kredit = $per_rekening->where('kredit', $pendapatan->id)->sum('nominal');
                                $total_pendapatan[] = $sisi_debit + $sisi_kredit; ?>
                                <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                            </tr>
                        @endforeach
                        {{-- Baris Total Pendapatan --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Pendapatan Penjualan')" :cols="__('2')" />
                            @if ($total_pendapatan)
                                <x-tabel.total-nominal :value="array_sum($total_pendapatan)" />
                            @else
                                <?php $total_pendapatan[] = [$sisi_debit + $sisi_kredit]; ?>
                                <x-tabel.total-nominal :value="0" />
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
                        <th colspan="3"
                            class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-sm font-bold leading-tiny tracking-wide text-left text-black uppercase border-y-4 border-double">
                            Beban
                        </th>
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
                            @if ($transaksis->where('debit', $beban->id)->isEmpty() && $transaksis->where('kredit', $beban->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            <tr>
                                <x-tabel.td :value="$beban->nomor" />
                                <x-tabel.td :value="$beban->nama" />
                                {{-- FIXME: kondisi jika kedua rekening sama ada di debit&kredit --}}
                                @foreach ($transaksis as $transaksi)
                                    {{-- filterisasi transaksi sesuai rekening --}}
                                    @if ($transaksi->debit == $beban->id || $transaksi->kredit == $beban->id)
                                        <?php $per_rekening->push($transaksi); ?>
                                    @endif
                                @endforeach
                                {{-- {{ dd($per_rekening) }} --}}
                                {{-- Penghitungan transaksi per bulan dari yang telah difilter sesuai rekening --}}
                                <?php $sisi_debit = $per_rekening->where('debit', $beban->id)->sum('nominal');
                                $sisi_kredit = $per_rekening->where('kredit', $beban->id)->sum('nominal') * -1;
                                $total_beban[] = $sisi_debit + $sisi_kredit; ?>

                                <x-tabel.td-nominal :value="$sisi_debit + $sisi_kredit" />
                            </tr>
                        @endforeach
                        {{-- Baris Total Beban --}}
                        <tr class="border-gray-400">
                            <x-tabel.total-col :value="__('Total Beban')" :cols="__('2')" />
                            @if ($total_beban)
                                <x-tabel.total-nominal :value="array_sum($total_beban)" />
                            @else
                                <?php $total_beban[] = [$sisi_debit + $sisi_kredit]; ?>
                                <x-tabel.total-nominal :value="0" />
                            @endif
                        </tr>
                    </tbody>
                    {{-- END Baris Total Beban --}}
                    {{-- END SECTION Tabel Beban --}}
                    {{-- Baris Total Laba Rugi --}}
                    <tr class="bg-zinc-200 border-gray-400">
                        <x-tabel.total-col :value="__('Laba Rugi')" :cols="__('2')" />
                        @if ($total_pendapatan)
                            <x-tabel.total-nominal :value="array_sum($total_pendapatan) - array_sum($total_beban)" />
                        @else
                            <x-tabel.total-nominal :value="0" />
                        @endif
                    </tr>
                    {{-- END Baris Total Laba Rugi --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- FIXME: kolom kredit masukkan ke dlm --}}
    {{-- FIXME: perbaiki yg kolom tanggal sama --}}
    {{-- END SECTION Tabel Data --}}
    {{-- SECTION Tombol Aksi --}}
    <form action="/tutup-buku/selesaikan" method="POST">
        @csrf
        <input type="hidden" name="nominal" value="{{ array_sum($total_pendapatan) - array_sum($total_beban) }}">
        <input type="hidden" name="awal" value="{{ request('awal') }}">
        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
        <button type="submit"
            class="bg-blue-600 text-zinc-50 opacity-85 px-3 py-2 mr-3 mt-5 rounded-sm font-medium text-sm lg:text-base antialiased">Lanjut
        </button>
        <a href="/tutup-buku">
            <button type="button"
                class="bg-zinc-500 text-zinc-50 opacity-85 px-3 py-2 mt-5 rounded-sm font-medium text-sm lg:text-base antialiased">Batal</button>
        </a>
    </form>
    {{-- SECTION Tombol Aksi --}}
@endsection
