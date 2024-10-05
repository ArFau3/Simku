@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Form Tanggal --}}
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
                    <button class="bg-amber-400 opacity-85 rounded-sm p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Oke</button>
                </div>
            </form>
            @if (request('awal'))
                <a href="/aktivitas" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
        </div>
        {{-- END Form Tanggal --}}
        {{-- Sisi Kanan --}}
        <div class="sm:flex">
            <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                <form action="" class="flex justify-between">
                    <input type="text"
                        class="border-0 bg-zinc-50 w-full sm:w-56 font-medium text-sm lg:text-sm focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                        name="cari" id="cari" placeholder="Keterangan" value="{{ request('cari') }}">
                    <button>
                        <i class="self-center fa fa-search text-gray-400" type="submit"></i>
                    </button>
                </form>
            </div>
            @if (request('cari'))
                <a href="{{ strtolower($title) }}" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
        </div>
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
                            <th colspan="2"
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Tanggal</th>
                            <th colspan="5"
                                class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Keterangan</th>
                            <th colspan="1"
                                class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Aksi</th>
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($aktivitas as $aktivitases)
                            <tr>
                                {{-- Tanggal --}}
                                <td colspan="2"
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ \Carbon\Carbon::parse($aktivitases->created_at)->isoFormat('DD/MM/YYYY HH:mm') }} WIB
                                </td>
                                {{-- END Tanggal --}}
                                {{-- Keterangan --}}
                                <td colspan="5" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">{!! ucfirst($aktivitases->deskripsi) !!}
                                    </div>
                                </td>
                                {{-- END Keterangan --}}
                                {{-- Aksi --}}
                                <td colspan="1" class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        @if ($aktivitases->old_rekening)
                                            <a href="/aktivitas-rekening/{{ $aktivitases->id }}"
                                                class="text-indigo-600 hover:text-indigo-900 pr-1.5 ">Cek
                                                Perubahan</a>
                                        @elseif($aktivitases->old_transaksi)
                                            <a href="/aktivitas-transaksi/{{ $aktivitases->id }}"
                                                class="text-indigo-600 hover:text-indigo-900 pr-1.5 ">Cek
                                                Perubahan</a>
                                        @endif
                                    </div>
                                </td>
                                {{-- END Aksi --}}
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
    {{-- Pagination --}}
    <div class="pt-3 grid justify-items-end">
        {{ $aktivitas->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
