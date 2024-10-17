@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($tbs) }} --}}
    {{-- SECTION tombol akses sebelum tabel --}}
    {{-- FIXME: tutup buku perlu ada cari --}}
    <div class="flex justify-between">
        <a href="tutup-buku/pilih-tanggal">
            <x-button.tambah :value="__('Lakukan Tutup Buku')" />
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
                            <x-tabel.head :value="__('Nomor')" />
                            <x-tabel.head :value="__('Tanggal')" />
                            <x-tabel.head :value="__('File Tutup Buku')" />
                            <x-tabel.head :value="__('Aksi')" />
                        </tr>
                    </thead>
                    {{-- END SECTION Header Tabel --}}
                    {{-- SECTION Body Tabel --}}
                    <tbody class="bg-white">
                        <?php $u = 0; ?>
                        @for ($i = 0; $i < $tbs->count(); $i++)
                            @if (!$tbs[$i]->akhir)
                                @continue
                            @endif
                            <?php $u += 1;
                            $tanggalAkhir = \Carbon\Carbon::parse($tbs[$i]->akhir)->format('d-m-Y');
                            $tanggalAwal = \Carbon\Carbon::parse($tbs[$i]->awal)->format('d-m-Y'); ?>
                            <tr>
                                <x-tabel.td :value="$u" />
                                <x-tabel.td :value="\Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y')" />
                                <?php $keterangan = 'Tutup Buku ' . $u . ' Periode ' . $tanggalAwal . ' s/d ' . $tanggalAkhir; ?>
                                <x-tabel.td :value="$keterangan" />
                                <td
                                    class="text-left font-medium py-2 px-4 sm:px-6  text-sm leading-tight text-gray-900 whitespace-no-wrap border-b border-gray-200">
                                    <a href="/tutup-buku/{{ $tbs[$i]->id }}"
                                        class="text-indigo-600 hover:text-indigo-900 pr-1.5 sm:border-black sm:border-r">Lihat</a>
                                    @if ($u == 1)
                                        {{-- FIXME: jika tutup buku dihapus tutp buku sebelumya kolom akhir hapus juga --}}
                                        <form action="/tutup-buku/hapus/{{ $tbs[$i]->id }}" method="POST" class="inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="text-indigo-600 hover:text-indigo-900"
                                                onclick="return confirm('Apakah Anda yakin ingin Menghapus Tutup Buku Terakhir {{ $tanggalAwal }} s/d {{ $tanggalAkhir }}')">Hapus</button>
                                        </form>
                                    @endif
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
        {{ $tbs->links() }}
    </div>
    {{-- END Pagination --}}
@endsection
