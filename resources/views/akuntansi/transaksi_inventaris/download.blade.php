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
                            <th
                                class="w-1 pl-4 pr-2 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                No.</th>
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Tanggal</th>{{-- sm:px-4 --}}
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Jenis Transaksi
                            </th>{{-- sm:px-4 --}}
                            <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                Debit - Kredit</th>{{-- sm:px-4 --}}
                            <th
                                class="px-4 border text-center  text-xs font-bold leading-4 tracking-wider text-black uppercase">
                                Keterangan</th>{{-- sm:px-4 --}}
                            <th
                                class=" px-4 text-xs font-bold leading-4 tracking-wider text-center
                                text-black uppercase">
                                Total</th>{{-- sm:px-4 --}}
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    {{-- HACK: pakai justify atau left? --}}
                    <tbody class="bg-white text-justify">
                        @for ($i = 0; $i < $transaksi->count(); $i++)
                            <?php $u = $i + 1; ?>
                            <tr>
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $u }}
                                </td>{{-- sm:px-6 --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y') }}
                                </td>{{-- sm:px-4 --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi[$i]->jenisTransaksi->jenis }}
                                </td>{{-- sm:px-4 --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi[$i]->rekeningDebit->nama }} - {{ $transaksi[$i]->rekeningKredit->nama }}
                                </td>{{-- sm:px-4 --}}
                                <td class=" py-1 px-2 text-sm leading-5 text-black">
                                    {{ $transaksi[$i]->keterangan }}
                                </td>{{-- sm:px-4 --}}
                                <td class="py-1 px-2 ">
                                    <div class="text-sm leading-5 text-black">
                                        {{ Number::currency($transaksi[$i]->nominal, 'IDR', 'id') }}
                                    </div>{{-- sm:px-4 --}}
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
