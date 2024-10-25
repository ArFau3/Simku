@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        {{-- Form Tanggal --}}
        <div class="md:flex">
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">
                @if (request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif
                <x-filter.tanggal />
            </form>
            @if (request('awal') != $user->koperasi->berdiri ||
                    request('akhir') != \Carbon\Carbon::now()->addDays(1)->toDateString())
                @if (request('cari'))
                    <form action="" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-filter.cancel-btn />
                    </form>
                @else
                    <a href="/aktivitas" class="my-1">
                        <x-filter.cancel-btn />
                    </a>
                @endif
            @endif
        </div>
        {{-- END Form Tanggal --}}
        {{-- Sisi Kanan --}}
        <div class="sm:flex">
            <div class="rounded w-full sm:w-64 border px-1 my-1 antialiased">
                <form action="" class="flex justify-between">
                    {{-- FIXME: perbaiki logic --}}
                    @if (request('awal'))
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                    @endif
                    <x-filter.cari />
                </form>
            </div>
            @if (request('cari'))
                @if (request('awal'))
                    <form action="" class="">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <x-filter.cancel-btn />
                    </form>
                @else
                    <a href="/aktivitas" class="">
                        <x-filter.cancel-btn />
                    </a>
                @endif
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
                            <x-tabel.head :value="__('Tanggal')" />
                            <x-tabel.head :value="__('Keterangan')" />
                            <x-tabel.head :value="__('Aksi')" />
                        </tr>
                    </thead>
                    {{-- END Header Tabel --}}
                    {{-- Body Tabel --}}
                    <tbody class="bg-white">
                        @foreach ($aktivitas as $aktivitases)
                            <tr>
                                {{-- Tanggal --}}
                                <x-tabel.td :value="\Carbon\Carbon::parse($aktivitases->created_at)->isoFormat(
                                    'DD/MM/YYYY HH:mm',
                                )" />
                                {{-- END Tanggal --}}
                                {{-- Keterangan --}}
                                {{-- HACK: harus pakai manual karna ada simbol dalam --}}
                                <th
                                    class='text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200'>
                                    {!! ucfirst($aktivitases->deskripsi) !!}
                                </th>
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
