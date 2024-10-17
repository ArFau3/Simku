@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    {{-- {{ dd($debit) }} --}}
    <div class="md:flex justify-between">
        {{-- Sisi Kiri --}}
        <div class="md:flex">
            {{-- Form Tanggal --}}
            {{-- Form --}}
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
                @if (request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif
                <x-filter.tanggal />
            </form>
            {{-- END Form --}}
            {{-- Cancel button --}}
            @if (request('awal') != $user->koperasi->berdiri || request('akhir') != $now)
                @if (request('cari'))
                    <form action="" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-filter.cancel-btn />
                    </form>
                @else
                    <a href="/buku-besar" class="my-1">
                        <x-filter.cancel-btn />
                    </a>
                @endif
            @endif
            {{-- END Cancel button --}}
            {{-- END Form Tanggal --}}
        </div>
        {{-- END Sisi Kiri --}}
        {{-- Sisi Kanan --}}
        <div class="sm:flex">
            {{-- Download Button --}}
            @if (request('awal') || request('cari'))
                @if (request('awal') && request('cari'))
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-button.download />
                    </form>
                @elseif(request('cari'))
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-button.download />
                    </form>
                @else
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <x-button.download />
                    </form>
                @endif
            @else
                <a href="buku-besar/download">
                    {{-- <a href="transaksi/download"> --}}
                    <x-button.download />
                </a>
            @endif
            {{-- END Download Button --}}
            {{-- Form Cari --}}
            <div class="flex">
                {{-- Form --}}
                <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                    <form action="" class="flex justify-between">
                        @if (request('awal'))
                            <input type="hidden" name="awal" value="{{ request('awal') }}">
                            <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        @endif
                        <x-filter.cari />
                    </form>
                </div>
                {{-- END Form --}}
                {{-- Cancel Button --}}
                @if (request('cari'))
                    @if (request('awal'))
                        <form action="" class="my-1">
                            <input type="hidden" name="awal" value="{{ request('awal') }}">
                            <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                            <x-filter.cancel-btn />
                        </form>
                    @else
                        <a href="/buku-besar" class="my-1">
                            <x-filter.cancel-btn />
                        </a>
                    @endif
                @endif
                {{-- END Cancel Button --}}
            </div>
            {{-- END Form Cari --}}
        </div>
        {{-- END Sisi Kanan --}}
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabels --}}
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
        <p class="px-4 sm:px-6 py-1 text-lg font-bold leading-tight tracking-wide text-left text-gray-900 uppercase">
            {{ $rekenings->nomor . ' | ' . $rekenings->nama }}
        </p>
        <hr class="border-zinc-800">
        {{-- END SECTION Nama Rekening Tabel --}}
        {{-- SECTION Tabel Data --}}
        <div class="flex flex-col mt-1 mb-10">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
                <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                    <table class="min-w-full">
                        {{-- Header Tabel --}}
                        <thead class="bg-zinc-300">
                            <tr>
                                <x-tabel.head :value="__('Tanggal')" />
                                <x-tabel.head :value="__('Jenis Transaksi')" />
                                <x-tabel.head :value="__('Keterangan')" />
                                <x-tabel.head :value="__('Debit')" />
                                <x-tabel.head :value="__('Kredit')" />
                                <x-tabel.head :value="__('Saldo')" />
                            </tr>
                        </thead>
                        {{-- END Header Tabel --}}
                        {{-- Body Tabel --}}
                        <tbody class="bg-white">
                            @foreach ($transaksi as $transaksis)
                                @if ($transaksis->debit == $rekenings->id || $transaksis->kredit == $rekenings->id)
                                    <tr>
                                        {{-- Kolom Tanggal --}}
                                        <x-tabel.td :value="\Carbon\Carbon::parse($transaksis->tanggal)->format('d/m/Y')" />
                                        {{-- END Kolom Tanggal --}}
                                        {{-- Kolom Jenis Transaksi --}}
                                        <x-tabel.td :value="$transaksis->jenisTransaksi->jenis" />
                                        {{-- END Kolom Jenis Transaksi --}}
                                        {{-- Kolom Keterangan --}}
                                        <x-tabel.td :value="$transaksis->keterangan" />
                                        {{-- END Kolom Keterangan --}}
                                        {{-- Kolom Debit --}}
                                        @if ($transaksis->debit == $rekenings->id)
                                            <x-tabel.td :value="Number::currency($transaksis->nominal, 'IDR', 'id')" />
                                            <?php $saldo_debit += $transaksis->nominal; ?>
                                        @else
                                            <x-tabel.td :value="__('-')" />
                                        @endif
                                        {{-- END Kolom Debit --}}
                                        {{-- Kolom Kredit --}}
                                        @if ($transaksis->kredit == $rekenings->id)
                                            <x-tabel.td :value="Number::currency($transaksis->nominal, 'IDR', 'id')" />
                                            <?php $saldo_kredit += $transaksis->nominal; ?>
                                        @else
                                            <x-tabel.td :value="__('-')" />
                                        @endif
                                        {{-- END Kolom Kredit --}}
                                        {{-- Kolom Saldo --}}
                                        {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                        {{-- FIXME: pendapatan jika di debit minus, kalau di kredit harusnnya plus. CEK LAGI SEMUA SUSUSNAN DEBIG/KREDIT REKENINGS --}}
                                        <?php $saldo = $saldo_debit - $saldo_kredit; ?>
                                        <x-tabel.td-nominal :value="$saldo" />
                                        {{-- END Kolom Saldo --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Kolom Total --}}
                            <tr>
                                <x-tabel.total-col :value="__('Total')" :cols="__('3')" />

                                {{-- Total Debit --}}
                                <x-tabel.total-nominal :value="$saldo_debit" />
                                {{-- END Total Debit --}}
                                {{-- Total Kredit --}}
                                <x-tabel.total-nominal :value="$saldo_kredit" />
                                {{-- END Total Kredit --}}
                                {{-- Total Saldo --}}
                                <?php $saldo = $saldo_debit - $saldo_kredit; ?>
                                <x-tabel.total-nominal :value="$saldo" />
                </div>
                </td>
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
    {{-- END SECTION Tabels --}}
    {{-- Pagination --}}
    @if (!(request('cari') || request('awal')))
        <div class="pt-3 grid justify-items-end">
            {{ $rekening->links() }}
        </div>
    @endif
    {{-- END Pagination --}}
@endsection
