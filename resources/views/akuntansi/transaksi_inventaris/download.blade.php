@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    {{-- SECTION Tabel Data --}}
    <div class="mt-5">
        <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}

            <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead>
                        <tr>
                            <x-download.thead :value="__('No.')" />
                            <x-download.thead :value="__('Tanggal')" />
                            <x-download.thead :value="__('Jenis Transaksi')" />
                            <x-download.thead :value="__('Debit - Kredit')" />
                            <x-download.thead :value="__('Keterangan')" />
                            <x-download.thead :value="__('Total')" />
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- HACK: pakai justify atau left? --}}
                    <tbody class="bg-white text-justify">
                        @for ($i = 0; $i < $transaksi->count(); $i++)
                            <?php $u = $i + 1; ?>
                            <tr>
                                <x-download.normal-td :value="$u" />
                                <x-download.normal-td :value="\Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y')" />
                                <x-download.normal-td :value="$transaksi[$i]->jenisTransaksi->jenis" />
                                <x-download.normal-td :value="$transaksi[$i]->rekeningDebit->nama .
                                    ' - ' .
                                    $transaksi[$i]->rekeningKredit->nama" />
                                <x-download.normal-td :value="$transaksi[$i]->keterangan" />
                                <x-download.nominal-td :value="$transaksi[$i]->nominal" />
                            </tr>
                        @endfor
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
@endsection
