<!DOCTYPE html>
<html>

<head>
    <title>Laporan Return Barang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
        }

        .summary {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3 style="text-align:center;">Laporan Return Barang</h3>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Kode Return</th>
                <th>Suplayer</th>
                <th>Tanggal Return</th>
                <th>Jumlah</th>
                <th>Alasan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $row)
                <tr>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ $row->kode_return }}</td>
                    <td>{{ $row->user->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_r)->format('d-m-Y') }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->alasan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Barang Return: {{ $totalReturn }}</p>
    </div>
</body>

</html>
