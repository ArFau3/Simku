<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title></title>
</head>

<body>
    <table class="table table-bordered">
        <thead>
            <tr>
                <td><b>Company Name</b></td>
                <td><b>Department Name</b></td>
                <td><b>Team Lead name</b></td>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekenings as $rekenings)
                <tr>
                    <td>
                        {{ $rekenings->nama }}
                    </td>
                    <td>
                        {{ $rekenings->nomor }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
