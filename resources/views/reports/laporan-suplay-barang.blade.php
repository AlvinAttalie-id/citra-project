<!DOCTYPE html>
<html>

<head>
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
            background: #f2f2f2;
        }

        .summary {
            margin-top: 15px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h3 style="text-align:center;">Laporan Suplay Barang</h3>

    <table>
        <thead>
            <tr>
                <th>Nomor Pengiriman</th>
                <th>Suplayer</th>
                <th>Kode Barang</th>
                <th>Tanggal</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $row)
                <tr>
                    <td>{{ $row->nomor_pengiriman }}</td>
                    <td>{{ $row->user->name ?? '-' }}</td>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_pengiriman)->format('d-m-Y') }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Barang Disuplay: {{ $totalSuplay }}</p>
    </div>
</body>

</html>
