<?php $total = collect([]); ?>
@extends('akuntansi.layouts.layout')
@section('content')
    {{-- SECTION Tabel Data --}}
    <p class="italic text-zinc-600 mb-3">
        Periode Tutup Buku: {{ \Carbon\Carbon::parse(request('awal'))->format('d M Y') }} s/d
        {{ \Carbon\Carbon::parse(request('akhir'))->format('d M Y') }}
        {{-- FIXME: tanggal bahasa indo --}}
    </p>
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Nomor Rekening
                            </th>
                            <th
                                class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Nama Rekening</th>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Debit</th>
                            <th
                                class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Kredit</th>
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($rekenings as $rekening)
                            {{-- HACK: lewati rekening jika tidak ada data transaksi --}}
                            @if ($transaksis->where('debit', $rekening->id)->isEmpty() && $transaksis->where('kredit', $rekening->id)->isEmpty())
                                @continue
                            @endif
                            {{-- ========================================= --}}
                            {{-- rekening --}}
                            <tr>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    {{ $rekening->nomor }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    {{ $rekening->nama }}
                                </td>
                                {{-- END rekening --}}
                                <?php $totalPerRekening = collect([]); ?>
                                {{-- Olah Data Transaksi per Rekening --}}
                                @foreach ($transaksis as $transaksi)
                                    {{-- skip data transaksi jika bukan bagian rekening yg diminta --}}
                                    @if (!($transaksi->debit == $rekening->id || $transaksi->kredit == $rekening->id))
                                        @continue
                                    @endif
                                    {{-- ========================================================= --}}
                                    {{-- If rekening beban --}}
                                    @if ($transaksi->debit == $rekening->id)
                                        <?php $totalPerRekening->push($transaksi->nominal); ?>
                                    @else
                                        <?php $totalPerRekening->push(-1 * $transaksi->nominal); ?>
                                    @endif
                                @endforeach
                                {{-- END Olah Data Transaksi per Rekening --}}
                                {{-- Debit/Kredit --}}
                                <?php $total_rekening = $totalPerRekening->sum();
                                $total->push($total_rekening); ?>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{-- If rekening beban --}}
                                        @if ($rekening->desimal >= 50000)
                                            @if ($total_rekening >= 0)
                                                {{ Number::currency($total_rekening, 'IDR', 'id') }}
                                            @else
                                                -
                                            @endif
                                            {{-- If rekening pendapatan --}}
                                        @else
                                            @if ($total_rekening > 0)
                                                ({{ Number::currency($total_rekening, 'IDR', 'id') }})
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{-- If rekening beban --}}
                                        @if ($rekening->desimal >= 50000)
                                            @if ($total_rekening >= 0)
                                                -
                                            @else
                                                ({{ Number::currency($total_rekening * -1, 'IDR', 'id') }})
                                            @endif
                                            {{-- If rekening pendapatan --}}
                                        @else
                                            @if ($total_rekening < 0)
                                                {{ Number::currency($total_rekening * -1, 'IDR', 'id') }}
                                            @elseif ($total_rekening == 0)
                                                {{ Number::currency($total_rekening, 'IDR', 'id') }}
                                            @else
                                                -
                                            @endif
                                        @endif
                                    </div>
                                </td>
                                {{-- END Debit/Kredit --}}
                            </tr>
                        @endforeach
                        {{-- Baris Total Debit == Kredit --}}
                        <tr class="border-2 border-gray-400">
                            {{-- Kolom Total --}}
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base ml-20 leading-5 text-gray-500 font-bold">
                                    Laba Rugi
                                </div>
                            </td>
                            {{-- END Kolom Total --}}
                            {{-- Kolom Nominal Total --}}
                            <td colspan="2" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-center text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($total->sum() * -1, 'IDR', 'id') }}
                                </div>
                            </td>
                            {{-- END Kolom Nominal Total --}}
                        </tr>
                        {{-- END Baris Total Debit == Kredit --}}
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
        <input type="hidden" name="nominal" value="{{ $total->sum() }}">
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
