@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dump($transaksi) }} --}}
    <section class="w-full p-8 mt-6 lg:mt-0 border rounded shadow">
        {{-- SECTION Form Input --}}
        <form action="update/{{ $transaksi->id }}" method="POST">
            @csrf
            <div class="md:flex md:justify-between">
                <div class="md:w-6/12">
                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="my-auto block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4"
                                for="my-select">
                                Tanggal
                            </label>
                        </div>
                        <div class="md:w-4/6 md:float-right">
                            <input id="date" name="tanggal" type="date"
                                class="form-input block w-full focus:bg-white" value="{{ $transaksi->tanggal }}"
                                id="my-textfield">
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                                Jenis Transaksi
                            </label>
                        </div>
                        <div class="md:w-4/6 md:float-right">
                            <select name="jenis" class="form-select block w-full focus:bg-white" id="my-select">
                                @foreach ($jenis as $jenis)
                                    <option value="{{ $jenis->id }}" @if ($jenis->id == $transaksi->jenis) selected @endif>
                                        {{ $jenis->jenis }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-select">
                                Untuk Biaya Debit
                            </label>
                        </div>
                        <div class="md:w-4/6">
                            <select name="debit" class="form-select block w-full focus:bg-white" id="my-select">
                                @foreach ($rekening as $rekening_debit)
                                    <option value="{{ $rekening_debit->id }}"
                                        @if ($rekening_debit->id == $transaksi->debit) selected @endif>
                                        {{ $rekening_debit->nomor . ' | ' . $rekening_debit->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="select">
                                Untuk Biaya Kredit
                            </label>
                        </div>
                        <div class="md:w-4/6">
                            <select name="kredit" class="form-select block w-full focus:bg-white" id="select">
                                @foreach ($rekening as $rekening_kredit)
                                    <option value="{{ $rekening_kredit->id }}"
                                        @if ($rekening_kredit->id == $transaksi->kredit) selected @endif>
                                        {{ $rekening_kredit->nomor . ' | ' . $rekening_kredit->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="md:w-5/12">
                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto float-left">
                            <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
                                Keterangan
                            </label>
                        </div>
                        <div class="md:w-4/6">
                            <textarea class="form-textarea block w-full focus:bg-white" id="my-textarea" name="keterangan" rows="6">{{ $transaksi->keterangan }}</textarea>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Total Harga
                            </label>
                        </div>
                        <div class="md:w-4/6 relative">
                            <input class="form-input block w-full focus:bg-white" id="my-textfield" name="nominal"
                                type="text" data-type="currency"
                                value="{{ Number::currency($transaksi->nominal, 'IDR', 'id') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- SECTION Tombol Aksi --}}
            <button class="bg-amber-400 opacity-85 p-2 mr-3 mt-5 font-medium text-sm lg:text-base antialiased"
                type="submit">Simpan</button>
            <a href="/transaksi">
                <button class="bg-amber-400 opacity-85 p-2 mt-5 font-medium text-sm lg:text-base antialiased">Batal</button>
            </a>
            {{-- SECTION Tombol Aksi --}}
        </form>
        {{-- END SECTION Form Input --}}
    </section>
@endsection
