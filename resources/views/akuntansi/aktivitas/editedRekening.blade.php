@extends('akuntansi.layouts.layout')

@section('content')
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
        <div class="md:flex justify-between">
            {{-- SECTION OLD --}}
            <div>
                {{-- Rekening Induk --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Rekening Induk
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_rekening->rekening_induk }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Rekening Induk --}}
                {{-- Nomor Rekening --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Nomor Rekening
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_rekening->nomor }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Nomor Rekening --}}
                {{-- Nama Rekening --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Nama Rekening
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <input disabled name="nama" class="form-input block w-full focus:bg-white" id="my-textfield"
                            type="text" value="{{ $old_rekening->nama }}">
                    </div>
                </div>
                {{-- END Nama Rekening --}}
            </div>
            {{-- END SECTION OLD --}}
            {{-- ICON ARROW --}}
            {{-- FIXME: SVG ICON --}}
            <div class="flex justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-12 h-7 mx-5 md:h-12 xl:mx-auto mb-3 md:mb-0 self-center">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </div>
            {{-- END ICON ARROW --}}
            {{-- SECTION CURRENT --}}
            <div>
                {{-- Rekening Induk --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Rekening Induk
                        </label>
                    </div>
                    {{-- HACK: failsafe jika current rekening induk sudah dihapus == data edit hilang karena referenced cascade --}}
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_rekening->rekeningInduk->nama }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Rekening Induk --}}
                {{-- Nomor Rekening --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Nomor Rekening
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_rekening->nomor }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Nomor Rekening --}}
                {{-- Nama Rekening --}}
                <div class="md:flex mb-6">
                    <div class="md:w-4/12 self-center">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Nama Rekening
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <input disabled name="nama" class="form-input block w-full focus:bg-white" id="my-textfield"
                            type="text" value="{{ $current_rekening->nama }}">
                    </div>
                </div>
                {{-- END Nama Rekening --}}
            </div>
            {{-- END SECTION CURRENT --}}
        </div>
    </section>
@endsection
