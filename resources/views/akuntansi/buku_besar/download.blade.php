@extends('akuntansi.layouts.download')
{{-- FIXME: tidak bisa pakai css terpisah --}}
@section('content')
    <p class="mt-5 uppercase text-sm font-bold tracking-tight antialiased">{{ $title }}</p>
    <p class="uppercase text-sm font-bold tracking-tight antialiased">per.
        {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
        {{ \Carbon\Carbon::now()->format('d M Y') }}
    </p>
    {{-- FIXME: pdf size auto adjusted with omnitor size --}}
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
        <p class="mt-5 mb-2 font-bold leading-4 tracking-wide text-left uppercase text-black">
            {{ $rekenings->nomor . ' | ' . $rekenings->nama }}
        </p>
        {{-- END SECTION Nama Rekening Tabel --}}
        {{-- SECTION Tabel Data --}}
        <div class="">
            <div class="py-2 -my-2 overflow-x-auto ">{{-- sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8  --}}
                <div class="inline-block min-w-full overflow-hidden align-middle m-3">{{-- shadow-sm sm:rounded-sm --}}
                    <table class="min-w-full">
                        {{-- SECTION Header Tabel --}}
                        <thead>
                            <tr>
                                <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                    Tanggal</th>{{-- sm:px-4 --}}
                                <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                    Jenis Transaksi
                                </th>{{-- sm:px-4 --}}
                                <th class="px-4 text-xs font-bold leading-4 tracking-wider text-center text-black uppercase">
                                    Keterangan</th>{{-- sm:px-4 --}}
                                <th
                                    class="px-4 border text-center  text-xs font-bold leading-4 tracking-wider text-black uppercase">
                                    Debit</th>{{-- sm:px-4 --}}
                                <th
                                    class=" px-4 text-xs font-bold leading-4 tracking-wider text-center
                                text-black uppercase">
                                    Kredit</th>{{-- sm:px-4 --}}
                                <th
                                    class=" px-4 text-xs font-bold leading-4 tracking-wider text-center
                                text-black uppercase">
                                    Saldo</th>
                            </tr>
                        </thead>
                        {{-- END SECTION Header Tabel --}}
                        {{-- Body Tabel --}}
                        <tbody class="bg-white text-justify">
                            @foreach ($transaksi as $transaksis)
                                @if ($transaksis->debit == $rekenings->id || $transaksis->kredit == $rekenings->id)
                                    <tr>
                                        {{-- Kolom Tanggal --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            {{ \Carbon\Carbon::parse($transaksis->tanggal)->format('d/m/Y') }}
                                        </td>
                                        {{-- END Kolom Tanggal --}}
                                        {{-- Kolom Jenis Transaksi --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            {{ $transaksis->jenisTransaksi->jenis }}
                                        </td>
                                        {{-- END Kolom Jenis Transaksi --}}
                                        {{-- Kolom Keterangan --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            {{ $transaksis->keterangan }}
                                        </td>
                                        {{-- END Kolom Keterangan --}}
                                        {{-- Kolom Debit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="text-sm leading-5 text-black font-medium">
                                                @if ($transaksis->debit == $rekenings->id)
                                                    {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                    <?php $saldo_debit += $transaksis->nominal; ?>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        {{-- END Kolom Debit --}}
                                        {{-- Kolom Kredit --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="text-sm leading-5 text-black font-medium">
                                                @if ($transaksis->kredit == $rekenings->id)
                                                    {{ Number::currency($transaksis->nominal, 'IDR', 'id') }}
                                                    <?php $saldo_kredit += $transaksis->nominal; ?>
                                                @else
                                                    -
                                                @endif
                                            </div>
                                        </td>
                                        {{-- END Kolom Kredit --}}
                                        {{-- Kolom Saldo --}}
                                        {{-- FIXME: rekening kredit kalau kredit > apakah dihitung minus ? --}}
                                        <td class="py-1 px-2 text-sm leading-5 text-black">
                                            <div class="text-sm leading-5 text-black font-medium">
                                                <?php $saldo = $saldo_debit - $saldo_kredit; ?>
                                                @if ($saldo >= 0)
                                                    {{ Number::currency($saldo, 'IDR', 'id') }}
                                                @else
                                                    ({{ Number::currency($saldo * -1, 'IDR', 'id') }})
                                                @endif
                                            </div>
                                        </td>
                                        {{-- END Kolom Saldo --}}
                                    </tr>
                                @endif
                            @endforeach
                            {{-- Kolom Total --}}
                            <tr>
                                <td colspan="3" class="py-1 px-2 text-sm font-bold text-center leading-5 text-black">
                                    Total</td>
                                {{-- Total Debit --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-black font-medium">
                                        {{ Number::currency($saldo_debit, 'IDR', 'id') }}
                                    </div>
                                </td>
                                {{-- END Total Debit --}}
                                {{-- Total Kredit --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-black font-medium">
                                        {{ Number::currency($saldo_kredit, 'IDR', 'id') }}
                                    </div>
                                </td>
                                {{-- END Total Kredit --}}
                                {{-- Total Saldo --}}
                                <td class="py-1 px-2 text-sm leading-5 text-black">
                                    <div class="text-sm leading-5 text-black font-medium">
                                        <?php $saldo = $saldo_debit - $saldo_kredit; ?>
                                        @if ($saldo >= 0)
                                            {{ Number::currency($saldo, 'IDR', 'id') }}
                                        @else
                                            ({{ Number::currency($saldo * -1, 'IDR', 'id') }})
                                        @endif
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
@endsection
