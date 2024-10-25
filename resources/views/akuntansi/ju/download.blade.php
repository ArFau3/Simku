@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    {{-- TODO: tambahkan total di bawah --}}
    {{-- SECTION Tabel Data --}}
    <div class="mt-5">
        <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}

            <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead>
                        <tr>
                            <x-download.thead :value="__('Tanggal')" />
                            <x-download.thead :value="__('Nomor Rekening')" />
                            <x-download.thead :value="__('Nama Rekening')" />
                            <x-download.thead :value="__('Debit')" />
                            <x-download.thead :value="__('Kredit')" />
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- HACK: pakai justify atau left? --}}
                    <tbody class="bg-white text-justify">
                        @foreach ($transaksi as $transaksi)
                            <tr>
                                {{-- Kolom Tanggal --}}
                                <x-download.normal-td :value="\Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y')" :rows="__('2')" />
                                {{-- END Kolom Tanggal --}}
                                {{-- Baris 1/Debit --}}
                                <x-download.normal-td :value="$transaksi->rekeningDebit->nomor" />
                                <x-download.normal-td :value="$transaksi->rekeningDebit->nama" />
                                <x-download.nominal-td :value="$transaksi->nominal" />
                                <x-download.normal-td :value="__('-')" />
                                {{-- END Baris 1/Debit --}}
                            </tr>
                            <tr>
                                {{-- Baris 2/Kredit --}}
                                <x-download.normal-td :value="$transaksi->rekeningKredit->nomor" />
                                <x-download.normal-td :value="$transaksi->rekeningKredit->nama" />
                                <x-download.normal-td :value="__('-')" />
                                <x-download.nominal-td :value="$transaksi->nominal" />
                                {{-- END Baris 2/Kredit --}}
                            </tr>
                        @endforeach
                        {{-- Baris Total Debit == Kredit --}}
                        {{-- $total = $transaksi->sum('nominal'); --}}
                        <tr class="border-2 border-gray-400">
                            {{-- Kolom Total --}}
                            <x-download.total-nominal :value="__('Total')" :cols="__('3')" />
                            {{-- END Kolom Total --}}
                            {{-- Kolom Debit --}}
                            <x-download.nominal :value="$total" />
                            {{-- END Kolom Debit --}}
                            {{-- Kolom Kredit --}}
                            <x-download.nominal :value="$total" />
                            {{-- END Kolom Kredit --}}
                        </tr>
                        {{-- END Baris Total Debit == Kredit --}}
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                    {{-- FIXME: rowspan error jika page breka, salah di library dompdf --}}
                </table>
            </div>
        </div>
    </div>
    {{-- FIXME: kolom kredit masukkan ke dlm --}}
    {{-- END SECTION Tabel Data --}}
@endsection
