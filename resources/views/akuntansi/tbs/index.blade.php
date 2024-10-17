<?php $total_aset = collect([]);
$total_kewajiban = collect([]);
$total_modal = collect([]); ?>
@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">

        {{-- Form Tanggal --}}
        <div class="md:flex">
            <a href="penjualan-tbs/pilih-rekening">
                <x-button.tambah :value="__('Tautkan Rekening')" />
            </a>
            <form action="" id="tahun" class="md:mx-2 mx-1 md:mb-0 mb-5">
                <select name="tahun" class="h-10 mt-1 md:mx-1 form-select block w-full focus:bg-white" id="my-select"
                    onchange='DoSubmit("tahun");'>
                    <?php $year = \Carbon\Carbon::now()->year; ?>
                    @for ($i = 0; $i < 10; $i++)
                        <option value="{{ $year - $i }}" {{ (int) request('tahun') == $year - $i ? 'selected' : '' }}>
                            {{ $year - $i }}
                        </option>
                    @endfor
                </select>
            </form>
            @if (request('tahun') && (int) request('tahun') != $tahun)
                <a href="/penjualan-tbs" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- FIXME: tidak rata verticality nya --}}
        </div>
        {{-- END Form Tanggal --}}
        {{-- FIXME: tabel keluar layout --}}
        {{-- FIXME: total debit kredit masih blm seimbang padahal sudah tutup buku --}}
        @if (request('awal'))
            <form action="neraca/download" class="my-1">
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
    {{-- Daftar rekening tertaut --}}
    <div class="flex mt-2">
        <p class="italic text-zinc-600 text-sm">Rekening yang ditautkan:
        </p>
        @foreach ($rekenings as $rekening)
            <form action="/penjualan-tbs/hapus/{{ $rekening->id }}" method="POST" class="inline">
                @method('DELETE')
                @csrf
                <button>
                    <p type="submit" class="mx-1 text-sm bg-cyan-400 px-1 rounded"
                        onclick="return confirm('Anda akan Menghapus Tautan {{ $rekening->rekenings->nama }}')">
                        {{ $rekening->rekenings->nama }}</p>
                </button>
            </form>
        @endforeach
    </div>
    {{-- END Daftar rekening tertaut --}}
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabel Data --}}
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th rowspan="2"
                                class="w-20 sm:w-16 pl-4 pr-2 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-800 uppercase border-b border-gray-200">
                                Uraian</th>
                            <th colspan="12"
                                class="w-20 sm:w-16 pl-4 pr-2 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-800 uppercase border-b border-gray-200">
                                {{ request('tahun') ? request('tahun') : $tahun }}</th>
                        </tr>
                        <tr>
                            @for ($i = 0; $i < 12; $i++)
                                <th
                                    class="w-20 sm:w-16 pl-4 pr-2 py-3 text-xs font-bold leading-4 tracking-wider text-center text-gray-800 uppercase border-b border-gray-200">
                                    {{ $bulans[$i] }}</th>
                            @endfor
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    @foreach ($rekenings as $rekening)
                        {{-- Siapin collection baru untuk hanya simpan transaksi sesuai rekening --}}
                        <?php $per_rekening = collect([]); ?>
                        <tr>
                            <td
                                class="font-medium pl-4 pr-2 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                {{ $rekening->rekenings->nama }}</td>
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

                                <td
                                    class="font-medium pl-4 pr-2 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ Number::currency($total_per_bulan, 'IDR', 'id') }}
                                </td>
                            @endfor
                        </tr>
                    @endforeach
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
@endsection
