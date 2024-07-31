@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    <p class="mt-5 uppercase text-sm font-bold tracking-tight antialiased">{{ $title }}</p>
    <p class="uppercase text-sm font-bold tracking-tight antialiased">per.
        {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
        {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>
    {{-- FIXME: pdf size auto adjusted with omnitor size --}}
    {{-- TODO: tambahkan total di bawah --}}
    {{-- SECTION Tabel Data --}}
    <div class="mt-5">
        <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}

            <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead>
                        <tr>
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Tanggal</th>{{-- sm:px-4 --}}
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Nomor Rekening
                            </th>{{-- sm:px-4 --}}
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Nama Rekening</th>{{-- sm:px-4 --}}
                            <th
                                class="px-4 border text-center  text-xs font-bold leading-4 tracking-wider text-black uppercase">
                                Debit</th>{{-- sm:px-4 --}}
                            <th
                                class=" px-4 text-xs font-bold leading-4 tracking-wider text-center
                                text-black uppercase">
                                Kredit</th>{{-- sm:px-4 --}}
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- HACK: pakai justify atau left? --}}
                    <tbody class="bg-white text-justify">
                        @foreach ($transaksi as $transaksi)
                            <tr>
                                {{-- Kolom Tanggal --}}
                                <td rowspan="2" class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}
                                </td>
                                {{-- END Kolom Tanggal --}}
                                {{-- Baris 1/Debit --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi->rekeningDebit->nomor }}
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi->rekeningDebit->nama }}
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{ Number::currency($transaksi->nominal, 'IDR', 'id') }}
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        -
                                    </div>
                                </td>
                                {{-- END Baris 1/Debit --}}
                            </tr>
                            <tr>
                                {{-- Baris 2/Kredit --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi->rekeningKredit->nomor }}
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi->rekeningKredit->nama }}
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        -
                                    </div>
                                </td>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{ Number::currency($transaksi->nominal, 'IDR', 'id') }}
                                        {{-- {{ dd($transaksi->sum('nominal')) }} --}}
                                    </div>
                                </td>
                                {{-- END Baris 2/Kredit --}}
                            </tr>
                        @endforeach
                        {{-- Baris Total Debit == Kredit --}}
                        <?php $total = $transaksi->sum('nominal'); ?>
                        <tr class="border-2 border-gray-400">
                            {{-- Kolom Total --}}
                            <td colspan="3" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    TOTAL
                                </div>
                            </td>
                            {{-- END Kolom Total --}}
                            {{-- Kolom Debit --}}
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ Number::currency($total, 'IDR', 'id') }}
                                </div>
                            </td>
                            {{-- END Kolom Debit --}}
                            {{-- Kolom Kredit --}}
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ Number::currency($total, 'IDR', 'id') }}
                                </div>
                            </td>
                            {{-- END Kolom Kredit --}}
                        </tr>
                        {{-- END Baris Total Debit == Kredit --}}
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- FIXME: kolom kredit masukkan ke dlm --}}
    {{-- END SECTION Tabel Data --}}
@endsection
