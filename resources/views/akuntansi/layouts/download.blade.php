<!doctype html>
<html lang="en">
{{-- FIXME: tidak bisa pakai css terpisah --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Download Data | Simku</title>
    {{-- <link href="/css/style.css" rel="stylesheet"> --}}
    {{-- @vite('resources/css/app.css') --}}
    <style>
        /* RESET CSS */
        /* http://meyerweb.com/eric/tools/css/reset/ v2.0 | 20110126 License: none (public domain) */

        html,
        body,
        div,
        span,
        applet,
        object,
        iframe,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        pre,
        a,
        abbr,
        acronym,
        address,
        big,
        cite,
        code,
        del,
        dfn,
        em,
        img,
        ins,
        kbd,
        q,
        s,
        samp,
        small,
        strike,
        strong,
        sub,
        sup,
        tt,
        var,
        b,
        u,
        i,
        center,
        dl,
        dt,
        dd,
        ol,
        ul,
        li,
        fieldset,
        form,
        label,
        legend,
        table,
        caption,
        tbody,
        tfoot,
        thead,
        tr,
        th,
        td,
        article,
        aside,
        canvas,
        details,
        embed,
        figure,
        figcaption,
        footer,
        header,
        hgroup,
        menu,
        nav,
        output,
        ruby,
        section,
        summary,
        time,
        mark,
        audio,
        video {
            margin: 0;
            /* margin-left: 0;
            margin-right: 0; */
            padding: 0;
            border: 0;
            font-size: 100%;
            font: inherit;
            vertical-align: baseline;
        }

        /* HTML5 display-role reset for older browsers */
        article,
        aside,
        details,
        figcaption,
        figure,
        footer,
        header,
        hgroup,
        menu,
        nav,
        section {
            display: block;
        }

        body {
            line-height: 1;
        }

        ol,
        ul {
            list-style: none;
        }

        blockquote,
        q {
            quotes: none;
        }

        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: '';
            content: none;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }

        /* ======================================================= */
        table,
        th,
        td {
            border: 1px solid black;
        }

        .text-xl {
            font-size: 1.25rem;
            line-height: 1.75rem
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .uppercase {
            text-transform: uppercase
        }

        .leading-tiny {
            line-height: .75rem
        }

        .tracking-wider {
            letter-spacing: .05em
        }

        .tracking-wide {
            letter-spacing: .025em
        }

        .font-bold {
            font-weight: 700
        }

        .tracking-tight {
            letter-spacing: -.025em
        }

        .flex {
            display: flex
        }

        .py-2 {
            padding-top: .5rem;
            padding-bottom: .5rem
        }

        .-my-2 {
            margin-top: -.5rem;
            margin-bottom: -.5rem
        }

        .overflow-x-auto {
            overflow-x: auto
        }

        .inline-block {
            display: inline-block
        }

        .min-w-full {
            min-width: 100%
        }

        .overflow-hidden {
            overflow: hidden
        }

        .align-middle {
            vertical-align: middle
        }

        .pl-4 {
            padding-left: 1rem
        }

        .pr-2 {
            padding-right: .5rem
        }

        .py-3 {
            padding-top: .75rem;
            padding-bottom: .75rem
        }

        .text-xs {
            font-size: .75rem;
            line-height: 1rem
        }

        .flex-col {
            flex-direction: column
        }

        .items-center {
            align-items: center
        }

        .font-semibold {
            font-weight: 600
        }

        .border-double {
            border-top-style: double;
            border-bottom-style: double
        }

        .border-4 {
            border-width: 4px
        }

        .my-2 {
            margin-top: .5rem;
            margin-bottom: .5rem
        }

        .border-black {
            --tw-border-opacity: 1;
            border-color: rgb(0 0 0 / var(--tw-border-opacity))
        }

        .bg-transparent {
            background-color: transparent
        }

        .text-center {
            text-align: center
        }

        .text-black {
            --tw-text-opacity: 1;
            color: rgb(0 0 0 / var(--tw-text-opacity))
        }

        .px-4 {
            padding-left: 1rem;
            padding-right: 1rem
        }

        .p-1 {
            padding: .25rem
        }

        .px-2 {
            padding-left: .5rem;
            padding-right: .5rem
        }

        .py-1 {
            padding-top: .25rem;
            padding-bottom: .25rem
        }

        .text-left {
            text-align: left
        }

        .bg-white {
            --tw-bg-opacity: 1;
            background-color: rgb(255 255 255 / var(--tw-bg-opacity))
        }

        .font-medium {
            font-weight: 500
        }

        .mb-7 {
            margin-bottom: 1.75rem
        }

        .mt-5 {
            margin-top: 1.25rem
        }

        .text-sm {
            font-size: .875rem;
            line-height: 1.25rem
        }

        .leading-5 {
            line-height: 1.25rem
        }

        .mt-3 {
            margin-top: .75rem
        }

        .p-2 {
            padding: .5rem
        }

        .p-6 {
            padding: 1.5rem
        }

        .my-1 {
            margin-top: .25rem;
            margin-bottom: .25rem
        }

        .mt-10 {
            margin-top: 2.5rem
        }

        .text-justify {
            text-align: justify;
        }

        .w-1 {
            width: 0.25rem;
        }

        .pt-2 {
            padding-top: .5rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .invisible {
            visibility: hidden
        }

        .mt-4 {
            margin-top: 1rem
        }

        .mb-1 {
            margin-bottom: .25rem
        }

        .mb-2 {
            margin-bottom: .5rem
        }

        .object-contain {
            -o-object-fit: contain;
            object-fit: contain
        }

        .float-left {
            float: left
        }

        .max-h-20 {
            max-height: 5rem
        }

        .flex-shrink-0,
        .shrink-0 {
            flex-shrink: 0
        }

        .mr-2 {
            margin-right: .5rem
        }

        .justify-between {
            justify-content: space-between
        }

        .text-lg {
            font-size: 1.125rem;
            line-height: 1.75rem
        }

        .p-10 {
            padding: 2.5rem;
        }

        .border-y-2 {
            border-top-width: 2px;
            border-bottom-width: 2px;
        }

        .border-y-4 {
            border-top-width: 3px;
            border-bottom-width: 3px;
        }

        .leading-tight {
            line-height: 1rem;
        }
    </style>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>

    {{-- <link rel="stylesheet" href="assets/css/mains.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/uicons-regular-straight/css/uicons-regular-straight.css'> --}}
</head>

<body class="mt-3">
    <div class="text-center p-10">
        {{-- Section Kop --}}
        {{-- FIXME: font --}}
        <p class="text-lg antialiased uppercase font-bold tracking-wide">{{ $user->koperasi->nama }}</p>
        <p class="font-semibold antialiased ">Badan Hukum Nomor : {{ $user->koperasi->hukum }}</p>
        <p class=" antialiased my-1">Alamat : {{ $user->koperasi->alamat }}</p>
        {{-- END Section Kop --}}

        <hr class=" border-y-2 border-black my-2 bg-transparent">

        {{-- Section Judul --}}
        <p class="mt-5 uppercase font-bold tracking-tight antialiased">{{ $title }}</p>
        <p class="text-sm tracking-tight antialiased mb-1">Per.
            @if (request('awal'))
                {{ \Carbon\Carbon::parse(request('awal'))->format('d M Y') }}
            @else
                {{ \Carbon\Carbon::parse($user->koperasi->berdiri)->format('d M Y') }}
            @endif
            s/d
            {{-- FIXME: bulan tampilkan fullname + pastikan bahasa indo --}}
            @if (request('akhir'))
                {{ \Carbon\Carbon::parse(request('akhir'))->format('d M Y') }}
            @else
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            @endif
        </p>
        {{-- END Section Judul --}}
        @yield('content')
    </div>
</body>

</html>
