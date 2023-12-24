@extends('akuntansi.layouts.layout')

@section('content')
    <section class="w-full p-8 mt-6 lg:mt-0 rounded shadow">
        <form>
            <div class="md:flex mb-6">
                <div class="md:w-1/6">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                        Rekening Induk
                    </label>
                </div>
                <div class="md:w-5/6">
                    <select name="" class="form-select block w-full focus:bg-white" id="my-select">
                        @foreach ($rekening as $rekening)
                            <option value="{{ $rekening->nama }}">
                                {{ $rekening->nomor . ' | ' . $rekening->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="md:flex mb-6">
                <div class="md:w-1/6">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nomor Rekening
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                        value="Test">
                </div>
            </div>

            <div class="md:flex mb-6">
                <div class="md:w-1/6">
                    <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                        Nama Rekening
                    </label>
                </div>
                <div class="md:w-5/6">
                    <input class="form-input block w-full focus:bg-white" id="my-textfield" type="text" value="">
                </div>
            </div>
        </form>

        <a href="/rekening/tambah">
            <button
                class="bg-amber-400 opacity-85 p-2 mr-3 mt-5 font-medium text-sm lg:text-base antialiased">Simpan</button>
        </a>
        <a href="/rekening">
            <button class="bg-amber-400 opacity-85 p-2 mt-5 font-medium text-sm lg:text-base antialiased">Batal</button>
        </a>
    </section>
@endsection
