@extends('akuntansi.layouts.layout')

@section('content')
    {{-- FIXME: view --}}
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
        <div class="md:flex md:justify-between">
            <div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Tanggal
                        </label>
                    </div>
                    <div class="md:w-4/6 md:float-right">
                        <input disabled id="date" name="tanggal" type="date"
                            class="form-input block w-full focus:bg-white" value="{{ $old_transaksi->tanggal }}"
                            id="my-textfield">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Jenis Transaksi
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->jenis }}" data-type="nomor_rekening">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Untuk Biaya Debit
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->debit }}" data-type="nomor_rekening">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="select">
                            Untuk Biaya Kredit
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $old_transaksi->kredit }}" data-type="nomor_rekening">
                    </div>
                </div>


                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto float-left">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                            Keterangan
                        </label>
                    </div>
                    <div class="md:w-4/6">
                        <textarea disabled class="form-textarea block w-full focus:bg-white" id="my-textarea" name="keterangan" rows="6">{{ $old_transaksi->keterangan }}</textarea>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Total Harga
                        </label>
                    </div>
                    <div class="md:w-4/6 relative">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" name="nominal"
                            type="text" data-type="currency"
                            value="{{ str_replace(',00', '', Number::currency($old_transaksi->nominal, 'IDR', 'id')) }}">
                    </div>
                </div>

            </div>
            <div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Tanggal
                        </label>
                    </div>
                    <div class="md:w-4/6 md:float-right">
                        <input disabled id="date" name="tanggal" type="date"
                            class="form-input block w-full focus:bg-white" value="{{ $current_transaksi->tanggal }}"
                            id="my-textfield">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Jenis Transaksi
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->jenisTransaksi->jenis }}" data-type="nomor_rekening">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                            Untuk Biaya Debit
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->rekeningDebit->nama }}" data-type="nomor_rekening">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="select">
                            Untuk Biaya Kredit
                        </label>
                    </div>
                    <div disabled class="md:w-5/6">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" type="text"
                            value="{{ $current_transaksi->rekeningKredit->nama }}" data-type="nomor_rekening">
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto float-left">
                        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                            Keterangan
                        </label>
                    </div>
                    <div class="md:w-4/6">
                        <textarea disabled class="form-textarea block w-full focus:bg-white" id="my-textarea" name="keterangan"
                            rows="6">{{ $current_transaksi->keterangan }}</textarea>
                    </div>
                </div>

                <div class="md:flex mb-6">
                    <div class="md:w-2/6 my-auto">
                        <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                            Total Harga
                        </label>
                    </div>
                    <div class="md:w-4/6 relative">
                        <input disabled class="form-input block w-full focus:bg-white" id="my-textfield" name="nominal"
                            type="text" data-type="currency"
                            value="{{ str_replace(',00', '', Number::currency($current_transaksi->nominal, 'IDR', 'id')) }}">
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
