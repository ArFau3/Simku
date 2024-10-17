@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($rekening) }} --}}
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Sisi Kiri --}}
        <a href="rekening/tambah">
            <x-button.tambah :value="__('Tambah Rekening')" />
        </a>
        {{-- END Sisi Kiri --}}
        {{-- Sisi Kanan --}}
        <div class="sm:flex">
            {{-- Form Cari --}}
            <div class="flex">
                {{-- Form --}}
                <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                    <form action="" class="flex justify-between">
                        <x-filter.cari />
                    </form>
                </div>
                {{-- END Form --}}
                {{-- Cancel button --}}
                @if (request('cari'))
                    <a href="rekening" class="my-1">
                        <x-filter.cancel-btn />
                    </a>
                @endif
                {{-- END Cancel button --}}
                {{-- END Form Cari --}}
            </div>
            {{-- Sisi Kanan --}}
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
                            <x-tabel.head :value="__('Nomor Rekening')" />
                            <x-tabel.head :value="__('Nama Rekening')" />
                            <x-tabel.head :value="__('Aksi')" />
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($rekenings as $rekening)
                            <tr>
                                <x-tabel.td :value="$rekening->nomor" />
                                <x-tabel.td :value="$rekening->nama" />
                                <td
                                    class="text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
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
    {{-- Pagination --}}
    <div class="pt-3 grid justify-items-end">
        {{ $rekenings->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
