<!DOCTYPE html>
<html>

<head>
    <title>Laporan Barang Keluar</title>
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
    <h3 style="text-align:center;">Laporan Barang Keluar</h3>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Jenis Barang</th>
                <th>Dibuat Oleh</th>
                <th>Tanggal Keluar</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $row)
                <tr>
                    <td>{{ $row->kode_barang }}</td>
                    <td>{{ $row->stokBarang->jenis_barang ?? '-' }}</td>
                    <td>{{ $row->admin->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_keluar)->format('d-m-Y') }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>{{ ucfirst($row->status) }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Barang Keluar: {{ $totalKeluar }}</p>
        <p>Total Barang Return: {{ $totalReturn }}</p>
    </div>
</body>

</html>
