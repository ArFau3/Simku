@extends('akuntansi.layouts.layout')

@section('content')
    <div class="mb-3">
        <p class="italic text-zinc-600 text-lg">Selamat datang di Sistem Informasi Akuntansi Koperasi Perkebunan Tapang Dadap
        </p>

        {!! $chart->container() !!}
    </div>
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}
@endsection
