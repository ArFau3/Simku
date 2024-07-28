@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    <p class="mt-5 uppercase text-sm font-bold tracking-tight antialiased">{{ $title }}</p>
    <p class="uppercase text-sm font-bold tracking-tight antialiased">per.
        {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
        {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>
    {{-- SECTION Tabel Data --}}
    <div class="flex flex-col mt-5">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead>
                        <tr>
                            <th
                                class="border border-black pl-4 pr-2 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase">
                                Nomor</th>
                            <th
                                class="border border-black px-4 sm:px-4 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase">
                                Tanggal</th>
                            <th
                                class="border border-black px-4 sm:px-4 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase">
                                Jenis Transaksi
                            </th>
                            <th
                                class="border border-black px-4 sm:px-4 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase">
                                Debit - Kredit</th>
                            <th
                                class="px-4 sm:px-4 border text-center border-black text-xs font-bold leading-4 tracking-wider text-gray-800 uppercase">
                                Keterangan</th>
                            <th class=border-black px-4 sm:px-4 text-xs font-bold leading-4 tracking-wider text-left
                                text-gray-800 uppercase">
                                Total</th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @for ($i = 0; $i < $transaksi->count(); $i++)
                            <?php $u = $i + 1; ?>
                            <tr>
                                <td
                                    class="font-medium pl-4 pr-2 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrapborder border-black">
                                    {{ $u }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrapborder border-black">
                                    {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y') }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrapborder border-black">
                                    {{ $transaksi[$i]->jenisTransaksi->jenis }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrapborder border-black">
                                    {{ $transaksi[$i]->rekeningDebit->nama }} - {{ $transaksi[$i]->rekeningKredit->nama }}
                                </td>
                                <td
                                    class="text-left font-medium px-4 sm:px-4 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrapborder border-black">
                                    {{ $transaksi[$i]->keterangan }}
                                </td>
                                <td class="px-4 sm:px-4 py-3 whitespace-no-wrapborder-black">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        {{ Number::currency($transaksi[$i]->nominal, 'IDR', 'id') }}
                                    </div>
                                </td>
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
