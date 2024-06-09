@extends('akuntansi.layouts.layout')

@section('content')
    {{-- FIXME: view --}}
    {{-- {{ dd($rekening->rekening_induk) }} --}}
    {{-- HACK: apakah current rekening pakai yg terbaru ? atau pas diedit walaupun sekrang sudah berubah lagi ? --}}
    <section class="w-full p-8 mt-6 lg:mt-0 rounded border shadow">

        {{-- FIXME: SEMENTARA --}}
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
        <div class="flex justify-between">
            <div>
                {{-- Rekening Induk --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/6 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Rekening Induk
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_rekening->rekening_induk }}" data-type="nomor_rekening">
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
                            value="{{ $old_rekening->nomor }}" data-type="nomor_rekening">
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
                        <input disabled name="nama" class="form-input block w-full focus:bg-white" id="my-textfield"
                            type="text" value="{{ $old_rekening->nama }}">
                    </div>
                </div>
                {{-- END Nama Rekening --}}
            </div>
            <div>
                {{-- Rekening Induk --}}
                <div class="md:flex mb-6">
                    <div class="md:w-1/6 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Rekening Induk
                        </label>
                    </div>
                    {{-- HACK: failsafe jika current rekening induk sudah dihapus == data edit hilang karena referenced cascade --}}
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_rekening->rekeningInduk->nama }}" data-type="nomor_rekening">
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
                            value="{{ $current_rekening->nomor }}" data-type="nomor_rekening">
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
                        <input disabled name="nama" class="form-input block w-full focus:bg-white" id="my-textfield"
                            type="text" value="{{ $current_rekening->nama }}">
                    </div>
                </div>
                {{-- END Nama Rekening --}}
            </div>
        </div>
    </section>
@endsection
