<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Rusak</title>
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
    <h3 style="text-align:center;">Laporan Barang Rusak</h3>

    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Suplayer</th>
                <th>Jenis Barang</th>
                <th>Jumlah Rusak</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $row)
                <tr>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ $row->user->name ?? '-' }}</td>
                    <td>{{ $row->stokBarang->jenis_barang ?? '-' }}</td>
                    <td>{{ $row->jumlah_rusak }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Barang Rusak: {{ $totalRusak }}</p>
    </div>
</body>

</html>
