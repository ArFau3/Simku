@extends('akuntansi.layouts.layout')

@section('content')
    <section class="w-full p-8 mt-6 lg:mt-0 rounded border shadow">
        {{-- SECTION Form Input --}}
        <form method="POST" action="/rekening/tambah/simpan">
            @csrf
            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                        Rekening Induk
                    </label>
                </div>
                <div class="md:w-5/6">
                    <select name="induk" class="form-select block w-full focus:bg-white" id="my-select">
                        @foreach ($rekening as $rekening)
                            <option value="{{ $rekening->nama }}">
                                {{ $rekening->nomor . ' | ' . $rekening->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nomor Rekening
                    </label>
                </div>
                <?php $nomor = 0; ?>
                <div class="md:w-5/6">
                    <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                        value="{{ $nomor }}">
                    <input name="nomor" type="hidden" value="{{ $nomor }}">
                </div>
            </div>

            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nama Rekening
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input name="nama" class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                        value="">
                </div>
            </div>

            {{-- SECTION Tombol Aksi --}}
            <a href="/rekening/tambah/simpan">
                <button type="submit"
                    class="bg-amber-400 opacity-85 p-2 mt-5 font-medium text-sm lg:text-base antialiased">Simpan</button>
            </a>
            <a href="/rekening">
                <button type="button"
                    class="bg-amber-400 opacity-85 p-2 mt-5 font-medium text-sm lg:text-base antialiased">Batal</button>
            </a>
            {{-- SECTION Tombol Aksi --}}
        </form>
        {{-- END SECTION Form Input --}}
    </section>
@endsection
