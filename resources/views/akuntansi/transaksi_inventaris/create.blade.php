@extends('akuntansi.layouts.layout')

@section('content')
    <section class="w-full p-8 mt-6 lg:mt-0 border rounded shadow">
        {{-- SECTION Form Input --}}
        <form action="tambah/simpan" method="POST">
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
                            <input id="date" type="date" class="form-input block w-full focus:bg-white"
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
                            <select name="" class="form-select block w-full focus:bg-white" id="my-select">
                                <option value="">Pendapatan</option>
                                <option value="">Pengeluaran</option>
                                <option value="">Peralatan</option>
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
                            <select name="" class="form-select block w-full focus:bg-white" id="my-select">
                                @foreach ($rekening as $rekening_debit)
                                    <option value="{{ $rekening_debit->nama }}">
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
                            <select name="" class="form-select block w-full focus:bg-white" id="select">
                                @foreach ($rekening as $rekening_kredit)
                                    <option value="{{ $rekening_kredit->nama }}">
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
                            <textarea class="form-textarea block w-full focus:bg-white" id="my-textarea" rows="6"></textarea>
                        </div>
                    </div>

                    <div class="md:flex mb-6">
                        <div class="md:w-2/6 my-auto">
                            <label class=" block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textfield">
                                Total Harga
                            </label>
                        </div>
                        <div class="md:w-4/6 relative">
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <span class="text-black-500 sm:text-sm">Rp.</span>
                            </div>
                            <input class="form-input block w-full focus:bg-white pl-9" name="nominal" id="my-textfield"
                                type="number">
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
