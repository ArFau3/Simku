@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($kas) }} --}}
    <div class="mb-3">
        <div class="flex justify-between">
            <p class="italic text-zinc-600 text-lg">Selamat datang di Sistem Informasi Akuntansi Koperasi Perkebunan Tapang
                Dadap
            </p>
            <form action="" method="get">
                <input type="hidden" name="bulan" value="{{ !request('bulan') }}">
                <button class="bg-amber-400 opacity-85 rounded-sm p-1 font-medium text-sm lg:text-base antialiased"
                    type="submit">{{ request('bulan') ? 'Tampilkan dalam tahun' : 'tampilkan dalam bulan' }}</button>
            </form>
        </div>
        <div class="flex">
            <div class="w-6/12">{!! $kas_masuk->container() !!}</div>
            <div class="w-6/12">{!! $kas_keluar->container() !!}</div>
        </div>

    </div>
    <script src="{{ $kas_masuk->cdn() }}"></script>
    <script src="{{ $kas_keluar->cdn() }}"></script>

    {{ $kas_masuk->script() }}
    {{ $kas_keluar->script() }}
@endsection
