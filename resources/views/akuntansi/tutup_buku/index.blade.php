@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($tbs) }} --}}
    {{-- SECTION tombol akses sebelum tabel --}}
    {{-- FIXME: tutup buku perlu ada cari --}}
    <div class="flex justify-between">
        <a href="tutup-buku/pilih-tanggal">
            <button class="bg-amber-400 opacity-85 p-2 mt-1 rounded-sm font-medium text-sm lg:text-base antialiased">Lakukan
                Tutup Buku</button>
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
                                Nomor</th>
                            <th
                                class="px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Tanggal</th>
                            <th
                                class="px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                File Tutup Buku</th>
                            <th
                                class="w-16 sm:w-32 px-4 sm:px-6 py-1 text-xs font-bold leading-4 tracking-wider text-left text-gray-800 uppercase border-b border-gray-200">
                                Aksi</th>
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
                                <td
                                    class="font-medium px-4 sm:px-6 py-3 text-sm leading-5 text-gray-800 whitespace-no-wrap border-b border-gray-200">
                                    {{ $u }}</td>

                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        {{ \Carbon\Carbon::parse($tanggalAkhir)->format('d-m-Y') }}</div>
                                </td>
                                <td class="px-4 sm:px-6 py-3 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-800 font-medium">
                                        Tutup Buku {{ $u }} Periode
                                        {{ $tanggalAwal }} s/d
                                        {{ $tanggalAkhir }}</div>
                                </td>
                                <td
                                    class="px-4 sm:px-6 py-3 text-sm font-medium leading-5 whitespace-no-wrap border-b border-gray-200">
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
