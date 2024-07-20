@extends('akuntansi.layouts.layout')

@section('content')
    {{-- HACK: apakah current rekening pakai yg terbaru ? atau pas diedit walaupun sekrang sudah berubah lagi ? --}}
    <section class="w-full p-8 mt-6 lg:mt-0 rounded border shadow">

        {{-- HACK: SEMENTARA --}}
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
        <div class="md:flex md:justify-between">
            {{-- SECTION OLD --}}
            <div>
                {{-- Tanggal --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Tanggal
                        </label>
                    </div>
                    <div class="md:w-11/12 md:float-right">
                        <input disabled id="date" name="tanggal" type="date"
                            class="form-input block w-full focus:bg-white" value="{{ $old_transaksi->tanggal }}"
                            id="my-textfield">
                    </div>
                </div>
                {{-- END Tanggal --}}
                {{-- Jenis --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Jenis Transaksi
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->jenis }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Jenis --}}
                {{-- Debit --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Untuk Biaya Debit
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->debit }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Debit --}}
                {{-- Kredit --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="select">
                            Untuk Biaya Kredit
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->kredit }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Kredit --}}
                {{-- Keterangan --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto float-left">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                            Keterangan
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <textarea disabled class="form-textarea block w-full focus:bg-white" id="my-textarea" name="keterangan" rows="6">{{ $old_transaksi->keterangan }}</textarea>
                    </div>
                </div>
                {{-- END Keterangan --}}
                {{-- Nominal --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Total Harga
                        </label>
                    </div>
                    <div class="md:w-11/12 relative">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" name="nominal"
                            type="text" data-type="currency"
                            value="{{ str_replace(',00', '', Number::currency($old_transaksi->nominal, 'IDR', 'id')) }}">
                    </div>
                </div>
                {{-- END Nominal --}}
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
                {{-- Tanggal --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Tanggal
                        </label>
                    </div>
                    <div class="md:w-11/12 md:float-right">
                        <input disabled id="date" name="tanggal" type="date"
                            class="form-input block w-full focus:bg-white" value="{{ $current_transaksi->tanggal }}"
                            id="my-textfield">
                    </div>
                </div>
                {{-- END Tanggal --}}
                {{-- Jenis --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Jenis Transaksi
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->jenisTransaksi->jenis }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Jenis --}}
                {{-- Debit --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Untuk Biaya Debit
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->rekeningDebit->nama }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Debit --}}
                {{-- Kredit --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="select">
                            Untuk Biaya Kredit
                        </label>
                    </div>
                    <div disabled class="md:w-11/12">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->rekeningKredit->nama }}" data-type="nomor_rekening">
                    </div>
                </div>
                {{-- END Kredit --}}
                {{-- Keterangan --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto float-left">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                            Keterangan
                        </label>
                    </div>
                    <div class="md:w-11/12">
                        <textarea disabled class="form-textarea block w-full focus:bg-white" id="my-textarea" name="keterangan"
                            rows="6">{{ $current_transaksi->keterangan }}</textarea>
                    </div>
                </div>
                {{-- END Keterangan --}}
                {{-- Nominal --}}
                <div class="md:flex mb-6">
                    <div class="md:w-3/6 my-auto">
                        <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Total Harga
                        </label>
                    </div>
                    <div class="md:w-11/12 relative">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" name="nominal"
                            type="text" data-type="currency"
                            value="{{ str_replace(',00', '', Number::currency($current_transaksi->nominal, 'IDR', 'id')) }}">
                    </div>
                </div>
                {{-- END Nominal --}}
            </div>
            {{-- END SECTION CURRENT --}}
        </div>
    </section>
@endsection
