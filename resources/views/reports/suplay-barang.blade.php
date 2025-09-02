<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Suplay Barang</title>
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
            background-color: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <h2>Laporan Suplay Barang</h2>

    <table>
        <thead>
            <tr>
                <th>Nomor Pengiriman</th>
                <th>Supplier</th>
                <th>Kode Barang</th>
                <th>Tanggal Pengiriman</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $row)
                <tr>
                    <td>{{ $row->nomor_pengiriman }}</td>
                    <td>{{ $row->user?->name }}</td>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_pengiriman)->format('d-m-Y') }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
