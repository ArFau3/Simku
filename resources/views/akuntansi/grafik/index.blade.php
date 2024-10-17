@extends('akuntansi.layouts.layout')

@section('content')
    {{-- {{ dd($kas) }} --}}
    <div class="mb-3">
        <p class="italic text-zinc-600 text-lg">Selamat datang di Sistem Informasi Akuntansi Koperasi Perkebunan Tapang Dadap
        </p>

        {!! $kas->container() !!}
    </div>
    <script src="{{ $kas->cdn() }}"></script>

    {{ $kas->script() }}
@endsection
