@extends('akuntansi.layouts.layout')

@section('content')
    <div class="flex justify-between">
        <a href="rekening/tambah">
            <button class="bg-amber-400 opacity-80 p-2 mt-1 font-medium text-sm lg:text-base antialiased">Tambah
                Rekening</button>
        </a>
        <div class="flex rounded w-32 sm:w-60 justify-between border px-3 my-1 antialiased">
            <input type="text"
                class="border-0 bg-zinc-50 w-20 sm:w-48 font-medium text-sm lg:text-base focus:outline-zinc-50 focus:outline-none hover:cursor-pointer"
                name="cari" id="cari" placeholder="Cari">
            <button>
                <i class="self-center fa fa-search text-gray-400"></i>
            </button>
        </div>
    </div>
    <div class="w-full my-2 bg-zinc-400 h-[1px]"></div>

    <div class="flex flex-col mt-1">
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 ">
            <div class="inline-block min-w-full overflow-hidden border align-middle shadow-sm sm:rounded-sm">
                <table class="min-w-full">
                    <thead class="bg-zinc-200">
                        <tr>
                            <th
                                class="w-20 sm:w-24 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Nomor Rekening</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Nama Rekening</th>
                            <th
                                class="w-16 sm:w-32 px-4 sm:px-6 py-3 text-xs font-bold leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200">
                                Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white">
                        @foreach ($rekening as $rekening)
                            <tr>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-500 whitespace-no-wrap border-b border-gray-200">
                                    {{ $rekening->nomor }}</td>

                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-500 font-medium">{{ $rekening->nama }}</div>
                                </td>

                                <td
                                    class="px-4 sm:px-6 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
