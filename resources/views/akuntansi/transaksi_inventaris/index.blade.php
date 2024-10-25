@extends('akuntansi.layouts.layout')

@section('content')
    {{-- SECTION tombol akses sebelum tabel --}}
    <div class="md:flex justify-between">
        <div class="md:flex">
            {{-- SECTION Tambah Transaksi if halaman transaksi --}}
            @if ($title === 'Transaksi')
                <a href="transaksi/tambah">
                    <x-button.tambah :value="__('Tambah Transaksi')" />
                </a>
            @endif
            {{-- END SECTION Tambah Transaksi if halaman transaksi --}}
            {{-- <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5">

                <input id="awal" type="date" class="h-10 md:mx-1 mt-1 form-input block w-full p-1 focus:bg-white"
                    id="my-textfield" name="awal" value="{{ request('awal') }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 md:h-12 mx-auto">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>

                <input id="akhir" type="date" class="h-10 mt-1 md:mx-1 form-input block w-full p-1 focus:bg-white"
                    id="my-textfield" name="akhir" value="{{ request('akhir') }}">

                <div>
                    <button class="bg-amber-400 rounded-sm opacity-85 p-2 mt-1 font-medium text-sm lg:text-base antialiased"
                        type="submit">Cari</button>
                </div>
            </form> --}}
            <form action="" class="md:flex md:mx-2 mx-1 md:mb-0 mb-5 ">
                @if (request('cari'))
                    <input type="hidden" name="cari" value="{{ request('cari') }}">
                @endif
                <x-filter.tanggal />
            </form>
            @if (request('awal') != $user->koperasi->berdiri || request('akhir') != \Carbon\Carbon::now()->toDateString())
                @if (request('cari'))
                    <form action="" class="my-1">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-filter.cancel-btn />
                    </form>
                @else
                    <a href="{{ strtolower($title) }}" class="my-1">
                        <x-filter.cancel-btn />
                    </a>
                @endif
            @endif
        </div>
        <div class="sm:flex">
            @if ($title == 'Aset Tetap')
                <?php $link_download = '/inventaris'; ?>
            @else
                <?php $link_download = '/transaksi'; ?>
            @endif
            @if (request('awal') || request('cari'))
                @if (request('awal') && request('cari'))
                    <form action={{ $link_download . '/download' }} class="">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-button.download />
                    </form>
                @elseif(request('cari'))
                    <form action={{ $link_download . '/download' }} class="">
                        <input type="hidden" name="cari" value="{{ request('cari') }}">
                        <x-button.download />
                    </form>
                @else
                    <form action={{ $link_download . '/download' }} class="">
                        <input type="hidden" name="awal" value="{{ request('awal') }}">
                        <input type="hidden" name="akhir" value="{{ request('akhir') }}">
                        <x-button.download />
                    </form>
                @endif
            @else
                <a href={{ $link_download . '/download' }}>
                    {{-- <a href="transaksi/download"> --}}
                    <x-button.download />
                </a>
            @endif
            <div class="flex">
                <div class="rounded w-full sm:w-64 border px-1 antialiased">
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
                        <a href="{{ strtolower($title) }}" class="">
                            <x-filter.cancel-btn />
                        </a>
                    @endif
                @endif
            </div>
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
                            <x-tabel.head :value="__('Nomor')" />
                            <x-tabel.head :value="__('Tanggal')" />
                            <x-tabel.head :value="__('Jenis Transaksi')" />
                            <x-tabel.head :value="__('Debit - Kredit')" />
                            <x-tabel.head :value="__('Keterangan')" />
                            <x-tabel.head :value="__('Total')" />
                            <x-tabel.head :value="__('Aksi')" />
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        @for ($i = 0; $i < $transaksi->count(); $i++)
                            <?php $u = $i + 1; ?>
                            <tr>
                                <x-tabel.td :value="$u" />
                                <x-tabel.td :value="\Carbon\Carbon::parse($transaksi[$i]->tanggal)->format('d/m/Y')" />
                                <x-tabel.td :value="$transaksi[$i]->jenisTransaksi->jenis" />
                                <x-tabel.td :value="$transaksi[$i]->rekeningDebit->nama .
                                    ' - ' .
                                    $transaksi[$i]->rekeningKredit->nama" />
                                <x-tabel.td :value="$transaksi[$i]->keterangan" />
                                <x-tabel.td-nominal :value="$transaksi[$i]->nominal" />
                                <td
                                    class="text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
                                    <a href="transaksi/{{ $transaksi[$i]->id }}"
                                        class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="/transaksi/hapus/{{ $transaksi[$i]->id }}" method="POST" class="inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900"
                                            onclick="return confirm('Anda akan Menghapus Transaksi &quot;{{ $transaksi[$i]->keterangan }}&quot; yang terjadi di tanggal {{ \Carbon\Carbon::parse($transaksi[$i]->tanggal)->isoFormat('D MMMM Y') }}')">Hapus</button>
                                    </form>
                                    {{-- FIXME: jika data transaksi untuk tutup buku dihapus, tabel tutup bukunya diperbaiki --}}
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                    {{-- SECTION Body Tabel --}}
                </table>
            </div>
        </div>
    </div>
    {{-- END SECTION Tabel Data --}}
    {{-- Pagination --}}
    <div class="pt-3 grid justify-items-end">
        {{ $transaksi->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
