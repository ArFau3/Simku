@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd(request('awal')) }} --}}
    <section class="w-full p-8 mt-6 lg:mt-0 border rounded shadow">
        <p class="italic text-zinc-600 mb-10">
            <span class="font-bold">Penting!</span> Setelah proses tutup buku, Anda tidak dapat melakukan perubahan terhadap
            buku Anda
            pada rentang tanggal yang dipilih.
        </p>
        {{-- SECTION Form Input --}}
        {{-- FIXME: jika tanggal awal adalah besok, maka tanggal akhir tidak bisa hari ini --}}
        <form action="/lakukan-tutup-buku" method="POST">
            @csrf
            {{-- Form Tanggal Awal --}}
            <div class="md:flex md:justify-between">
                <div class="md:w-6/12">
                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-select">
                                Dari Tanggal
                            </label>
                        </div>
                        <div class="md:w-4/6 md:float-right">
                            <input id="awal" name="awal" type="date" value="{{ request('awal') }}"
                                min="{{ $tanggal_awal }}" class="form-input block w-full focus:bg-white" id="my-textfield">
                        </div>
                    </div>
                </div>
            </div>
            {{-- END Form Tanggal Awal --}}
            {{-- Form Tanggal Akhir --}}
            <div class="md:flex md:justify-between">
                <div class="md:w-6/12">
                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-select">
                                Sampai Tanggal
                            </label>
                        </div>
                        <div class="md:w-4/6 md:float-right">
                            <input id="akhir" name="akhir" type="date" value="{{ request('akhir') }}"
                                class="form-input block w-full focus:bg-white" id="my-textfield">
                        </div>
                    </div>
                </div>
            </div>
            {{-- END Form Tanggal Akhir --}}
            {{-- SECTION Tombol Aksi --}}
            <button type="submit"
                class="bg-blue-600 text-zinc-50 opacity-85 px-3 py-2 mr-3 mt-5 rounded-sm font-medium text-sm lg:text-base antialiased">Lanjut
            </button>
            <a href="/tutup-buku">
                <button type="button"
                    class="bg-zinc-500 text-zinc-50 opacity-85 px-3 py-2 mt-5 rounded-sm font-medium text-sm lg:text-base antialiased">Batal</button>
            </a>
            {{-- SECTION Tombol Aksi --}}
        </form>
        {{-- END SECTION Form Input --}}

    </section>
@endsection
