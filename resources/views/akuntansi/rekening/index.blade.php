@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($rekening) }} --}}
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="flex justify-between">
        <a href="rekening/tambah">
            <button class="bg-amber-400 opacity-85 p-2 mt-1 rounded-sm font-medium text-sm lg:text-base antialiased">Tambah
                Rekening</button>
        </a>
        <div class="flex">
            <div class="flex rounded w-32 sm:w-64 justify-between border px-3 my-1 antialiased">
                <form action="">
                    <input type="text"
                        class="border-0 bg-zinc-50 w-20 sm:w-52 font-medium text-sm lg:text-base focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                        name="cari" id="cari" placeholder="Nama/Nomor Rekening" value="{{ request('cari') }}">
                    <button>
                        <i class="self-center fa fa-search text-gray-400" type="submit"></i>
                    </button>
                </form>

            </div>
            @if (request('cari'))
                <a href="rekening" class="my-1">
                    <button
                        class="hover:opacity-90 hover:text-lg hover:my-0 self-center fa fa-times text-white bg-red-600 rounded p-2 ml-0.5 mt-1 font-medium text-sm lg:text-base antialiased"></button>
                </a>
            @endif
        </div>
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
                                class="w-20 sm:w-24 px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Nomor Rekening</th>
                            <th
                                class="px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Nama Rekening</th>
                            <th
                                class="w-16 sm:w-32 px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Aksi</th>
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($rekening as $rekening)
                            <tr>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $rekening->nomor }}</td>

                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">{{ $rekening->nama }}</div>
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                    @if ($rekening['edit'])
                                        <a href="/rekening/{{ $rekening->id }}"
                                            class="text-indigo-600 hover:text-indigo-900 pr-1.5 sm:border-black sm:border-r">Edit</a>
                                        <form action="/rekening/hapus/{{ $rekening->id }}" method="POST" class="inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900"
                                                onclick="return confirm('Apakah Anda yakin ingin Menghapus Rekening {{ $rekening->nama }}')">Hapus</button>
                                        </form>
                                    @else
                                        <i class="mx-auto fa fa-lock text-gray-900"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
@endsection
