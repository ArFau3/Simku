@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        <div class="md:flex">
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">

                <input id="awal" type="date" class="h-10 md:mx-1 mt-1 form-input block w-full focus:bg-white"
                    id="my-textfield" name="awal" value="{{ request('awal') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="akhir" type="date" class="h-10 mt-1 md:mx-1 form-input block w-full focus:bg-white"
                    id="my-textfield" name="akhir" value="{{ request('akhir') }}">

                <div>
                    <button class="bg-amber-400 opacity-80 p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Oke</button>
                </div>
            </form>
            @if (request('awal'))
                <a href="/jurnal-umum" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
        </div>
        <a href="transaksi/download">
            <button
                class="bg-amber-400 opacity-80 p-2 md:mb-0 mb-5 mx-1 mt-1 font-medium text-sm lg:text-base antialiased">Download</button>
        </a>
    </div>
    {{-- END SECTION tombol akses sebelum tabel --}}
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>
    {{-- SECTION Tabel Data --}}
    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    {{-- SECTION Header Tabel --}}
                    <thead class="bg-zinc-200">
                        <tr>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Tanggal</th>
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
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($transaksi as $transaksi)
                            <tr>
                                {{-- Kolom Tanggal --}}

                                <td rowspan="2"
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d/m/Y') }}
                                </td>

                                {{-- END Kolom Tanggal --}}
                                {{-- Baris 1/Debit --}}
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $transaksi->rekeningDebit->nomor }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $transaksi->rekeningDebit->nama }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{ Number::currency($transaksi->nominal, 'IDR', 'id') }}
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        -
                                    </div>
                                </td>
                                {{-- END Baris 1/Debit --}}
                            </tr>
                            <tr>
                                {{-- Baris 2/Kredit --}}
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    {{ $transaksi->rekeningKredit->nomor }}
                                </td>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    {{ $transaksi->rekeningKredit->nama }}
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        -
                                    </div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200 bg-zinc-100">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">
                                        {{ Number::currency($transaksi->nominal, 'IDR', 'id') }}
                                        {{-- {{ dd($transaksi->sum('nominal')) }} --}}
                                    </div>
                                </td>
                                {{-- END Baris 2/Kredit --}}
                            </tr>
                        @endforeach
                        {{-- Baris Total Debit = Kredit --}}
                        <tr class="border-2 border-gray-400">
                            <td colspan="3" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base text-center leading-5 text-gray-500 font-bold">
                                    TOTAL
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($ju->first()->jurnal_umum->total, 'IDR', 'id') }}
                                </div>
                            </td>
                            <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                <div class="text-base underline leading-5 text-gray-500 font-bold">
                                    {{ Number::currency($ju->first()->jurnal_umum->total, 'IDR', 'id') }}
                                </div>
                            </td>
                        </tr>
                        {{-- END Baris Total Debit = Kredit --}}
                    </tbody>
                    {{-- END SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
@endsection
