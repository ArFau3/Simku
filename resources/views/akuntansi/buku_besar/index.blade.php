@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    {{-- {{ dd($debit) }} --}}
    <div class="md:flex justify-between">
        {{-- Form Tanggal --}}
        <div class="md:flex">
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
                @if (request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif
                <input id="awal" type="date"
                    class="h-10 md:mx-1 rounded-sm mt-1 form-input block w-full focus:bg-white" id="my-textfield"
                    name="awal" value="{{ request('awal') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="akhir" type="date"
                    class="h-10 mt-1 rounded-sm md:mx-1 form-input block w-full focus:bg-white" id="my-textfield"
                    name="akhir" value="{{ request('akhir') }}">

                <div>
                    <button class="bg-amber-400 opacity-85 rounded-sm p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Oke</button>
                </div>
            </form>
            @if (request('awal'))
                @if (request('cari'))
                    <form action="" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <button type="submit"
                            class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                    </form>
                @else
                    <a href="/buku-besar" class="my-1">
                        <button
                            class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                    </a>
                @endif
            @endif
        </div>
        {{-- FIXME: saat filter/cari, pagination kacau, karna paginate dulu baru filter data data --}}
        {{-- FIXME: saat pindah page, filter hilang --}}
        {{-- END Form Tanggal --}}
        {{-- Sisi Kanan --}}
        <div class="sm:flex">
            @if (request('awal') || request('cari'))
                @if (request('awal') && request('cari'))
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <button
                            class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
                    </form>
                @elseif(request('cari'))
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <button
                            class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
                    </form>
                @else
                    <form action="buku-besar/download" class="my-1">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <button
                            class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
                    </form>
                @endif
            @else
                <a href="buku-besar/download">
                    {{-- <a href="transaksi/download"> --}}
                    <button
                        class="bg-green-600 rounded-sm text-zinc-50 opacity-85 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
                </a>
            @endif

            <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                <form action="" class="flex justify-between">
                    @if (request('awal'))
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                    @endif
                    <input type="text"
                        class="border-0 bg-zinc-50 w-full sm:w-56 font-medium text-sm lg:text-base focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                        name="cari" id="cari" placeholder="Keterangan/Jenis Transaksi"
                        value="{{ request('cari') }}">
                    <button>
                        <i class="self-center fa fa-search text-gray-400" type="submit"></i>
                    </button>
                </form>
            </div>
            @if (request('cari'))
                @if (request('awal'))
                    <form action="" class="my-1">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <button type="submit"
                            class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                    </form>
                @else
                    <a href="/buku-besar" class="my-1">
                        <button
                            class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                    </a>
                @endif
            @endif
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
        <p class="px-4 sm:px-6 py-1 text-lg font-bold leading-4 tracking-wide text-left text-gray-800 uppercase">
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
                        <thead class="bg-zinc-200">
                            <tr>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Tanggal</th>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Jenis Transaksi
                                </th>
                                <th
                                    class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Keterangan</th>
                                <th
                                    class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Debit</th>
                                <th
                                    class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Kredit</th>
                                <th
                                    class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                    Saldo</th>
                            </tr>
                        </thead>
                        {{-- END Header Tabel --}}
                        {{-- Body Tabel --}}
                        <tbody class="bg-white">
                            @foreach ($transaksi as $transaksis)
                                @if ($transaksis->debit == $rekenings->id || $transaksis->kredit == $rekenings->id)
                                    <tr>
                                        {{-- Kolom Tanggal --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            {{ \Carbon\Carbon::parse($transaksis->tanggal)->format('d/m/Y') }}
                                        </td>
                                        {{-- END Kolom Tanggal --}}
                                        {{-- Kolom Jenis Transaksi --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            {{ $transaksis->jenisTransaksi->jenis }}
                                        </td>
                                        {{-- END Kolom Jenis Transaksi --}}
                                        {{-- Kolom Keterangan --}}
                                        <td
                                            class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                            {{ $transaksis->keterangan }}
                                        </td>
                                        {{-- END Kolom Keterangan --}}
                                        {{-- Kolom Debit --}}
                                        <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                        <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                        <td class="px-4 sm:px-1 py-3 whitespace-no-wrap border-b border-gray-200">
                                            <div class="text-sm leading-5 text-gray-800 font-medium">
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
                                <td colspan="3"></td>
                                {{-- Total Debit --}}
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        {{ Number::currency($saldo_debit, 'IDR', 'id') }}
                                    </div>
                                </td>
                                {{-- END Total Debit --}}
                                {{-- Total Kredit --}}
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        {{ Number::currency($saldo_kredit, 'IDR', 'id') }}
                                    </div>
                                </td>
                                {{-- END Total Kredit --}}
                                {{-- Total Saldo --}}
                                <td class="px-4 sm:px-1 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
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
    {{-- END SECTION Tabels --}}
    {{-- Pagination --}}
    <div class="pt-3 grid justify-items-end">
        {{ $rekening->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
