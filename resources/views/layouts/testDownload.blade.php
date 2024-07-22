<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
    <style>
        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    {{-- {{ dd($rekenings[0]) }} --}}
    <table class="table table-bordered">
        <thead>
            <tr>
                <td><b>Company Name</b></td>
                <td><b>Department Name</b></td>
                <td><b>Team Lead name</b></td>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $rekenings->count(); $i++)
                {{-- <p>Page 1</p> --}}
                <tr>
                    <td>
                        {{ $rekenings[$i]->nama }}
                    </td>
                    <td>
                        {{ $rekenings[$i]->nomor }}
                    </td>
                </tr>

                @if (($i + 1) % 10 == 0)
                    <p>Page {{ $i }}</p>
                    <div class="page-break"></div>
                @endif
                {{-- foreach ($rekenings as $rekenings)
                <tr>
                    <td>
                        {{ $rekenings->nama }}
                    </td>
                    <td>
                        {{ $rekenings->nomor }}
                    </td>
                </tr>
            endforeach --}}
            @endfor
        </tbody>
    </table>
</body>

</html>
