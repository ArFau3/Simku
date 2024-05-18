@extends('akuntansi.layouts.layout')

@section('content')
    <section class="w-full p-8 mt-6 lg:mt-0 rounded border shadow">
        {{-- SEMENTARA --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        {{-- SEMENTARA --}}


        {{-- SECTION Form Input --}}
        <form method="POST" action="/rekening/tambah/simpan">
            @csrf
            {{-- Rekening Induk --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="rekening_induk">
                        Rekening Induk
                    </label>
                </div>
                <div class="md:w-5/6">
                    <select name="induk" class="form-select block w-full focus:bg-white" id="rekening_induk">
                        @foreach ($rekening as $rekening)
                            <option value="{{ $rekening->id }}">
                                {{ $rekening->nomor . ' | ' . $rekening->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- END Rekening Induk --}}
            {{-- Nomor Rekening --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nomor Rekening
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                        data-type="nomor_rekening">
                    <input name="nomor" data-type="nomor_rekening" type="hidden">
                </div>
            </div>
            {{-- END Nomor Rekening --}}
            {{-- Nama Rekening --}}
            <div class="md:flex mb-6">
                <div class="md:w-1/6 self-center">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nama Rekening
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input name="nama" class="form-input block w-full focus:bg-white" id="my-textfield" type="text">
                </div>
            </div>
            {{-- END Nama Rekening --}}
            {{-- SECTION Tombol Aksi --}}
            <button type="submit"
                class="bg-amber-400 opacity-85 p-2 mr-3 mt-5 font-medium text-sm lg:text-base antialiased">Simpan
            </button>
            <a href="/rekening">
                <button type="button"
                    class="bg-amber-400 opacity-85 p-2 mt-5 font-medium text-sm lg:text-base antialiased">Batal</button>
            </a>
            {{-- SECTION Tombol Aksi --}}
        </form>
        {{-- END SECTION Form Input --}}
    </section>
@endsection
