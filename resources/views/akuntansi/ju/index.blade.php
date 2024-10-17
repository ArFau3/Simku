@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Sisi Kiri --}}
        <div class="md:flex">
            {{-- Form Tanggal --}}
            {{-- Form --}}
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
                <x-filter.tanggal />
            </form>
            {{-- END Form --}}
            {{-- Cancel Button --}}
            @if (request('awal') != $user->koperasi->berdiri || request('akhir') != \Carbon\Carbon::now()->toDateString())
                <a href="/jurnal-umum" class="my-1">
                    <x-filter.cancel-btn />
                </a>
            @endif
            {{-- END Cancel Button --}}
            {{-- Form Tanggal --}}
        </div>
        {{-- END Sisi Kiri --}}
        {{-- Sisi Kanan --}}
        @if (request('awal'))
            <form action="jurnal-umum/download" class="my-1">
                <input type="hidden" name="awal" value="{{ request('awal') }}">
                <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                <x-button.download />
            </form>
        @else
            <a href="jurnal-umum/download">
                <x-button.download />
            </a>
        @endif
        {{-- END Sisi Kanan --}}
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabel Data --}}
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <x-tabel.head :value="__('Tanggal')" />
                            <x-tabel.head :value="__('Nomor Rekening')" />
                            <x-tabel.head :value="__('Nama Rekening')" />
                            <x-tabel.head :value="__('Debit')" />
                            <x-tabel.head :value="__('Kredit')" />
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                {{-- Kolom Tanggal --}}
                                <td rowspan="2"
                                    class="text-left font-medium px-4 sm:px-6 py-2 text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}
                                </td>
                                {{-- END Kolom Tanggal --}}
                                {{-- Baris 1/Debit --}}
                                <x-tabel.td :value="$transaksi->rekeningDebit->nomor" />
                                <x-tabel.td :value="$transaksi->rekeningDebit->nama" />
                                <x-tabel.td :value="Number::currency($transaksi->nominal, 'IDR', 'id')" />
                                <x-tabel.td :value="__('-')" />
                                {{-- END Baris 1/Debit --}}
                            </tr>
                            <tr>
                                {{-- Baris 2/Kredit --}}
                                <x-tabel.td :value="$transaksi->rekeningKredit->nomor" />
                                <x-tabel.td :value="$transaksi->rekeningKredit->nama" />
                                <x-tabel.td :value="__('-')" />
                                <x-tabel.td :value="Number::currency($transaksi->nominal, 'IDR', 'id')" />
                                {{-- END Baris 2/Kredit --}}
                            </tr>
                        @endforeach
                        {{-- Baris Total --}}
                        <?php $total = $transaksis->sum('nominal'); ?>
                        <tr class="border-2 border-gray-400">
                            {{-- Kolom Label Total --}}
                            <x-tabel.total-col :value="__('Total')" :cols="__('3')" />
                            {{-- END Kolom Label Total --}}
                            {{-- Kolom Debit/Kredit --}}
                            <x-tabel.total-nominal :value="$total" />
                            <x-tabel.total-nominal :value="$total" />
                            {{-- END Kolom Debit/Kredit --}}
                        </tr>
                        {{-- END Baris Total --}}
                    </tbody>
                    {{-- END Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- FIXME: kolom kredit masukkan ke dlm --}}
    {{-- FIXME: perbaiki yg kolom tanggal sama --}}
    {{-- END SECTION Tabel Data --}}
    {{-- FIXME: kemungkinan jurnal umum dari tanggal terakhir tutup buku? --}}
    {{-- Pagination --}}
    <div class="pt-3 grid justify-items-end">
        {{ $transaksis->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
