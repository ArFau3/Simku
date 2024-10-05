@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($rekening) }} --}}
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="flex justify-between">
        <a href="/penjualan-tbs">
            <button
                class="bg-zinc-500 text-zinc-50 opacity-85 px-3 py-2 rounded-sm font-medium text-sm lg:text-base antialiased">Batal</button>
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
                        @foreach ($rekenings as $rekening)
                            <tr>
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $rekening->nomor }}</td>

                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">{{ $rekening->nama }}</div>
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
                                    {{-- Cek apakah rekening sudah tertaut --}}
                                    <?php $tertaut = false; ?>
                                    @foreach ($rekening_tertaut as $rekening_t)
                                        @if ($rekening->id == $rekening_t->rekening)
                                            <?php $tertaut = true; ?>
                                            @continue
                                        @endif
                                    @endforeach
                                    {{-- Tampilkan aksi sesuai rekening tertaut atau tidak --}}
                                    @if ($tertaut)
                                        <i class="mx-auto fa fa-lock text-gray-900"></i>
                                    @else
                                        <form action="/penjualan-tbs/tautkan/{{ $rekening->id }}" method="POST"
                                            class="inline">
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900"
                                                onclick="return confirm('Apakah Anda yakin ingin Menautkan Rekening {{ $rekening->nama }}')">Tautkan</button>
                                        </form>
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
