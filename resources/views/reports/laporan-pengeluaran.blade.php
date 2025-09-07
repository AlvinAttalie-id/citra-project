<!DOCTYPE html>
<html>

<head>
    <title>Laporan Pengeluaran</title>
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
    <h3 style="text-align:center;">Laporan Pengeluaran</h3>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Jenis Pengeluaran</th>
                <th>Tanggal</th>
                <th>Biaya</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($records as $row)
                <tr>
                    <td>{{ $row->slug }}</td>
                    <td>{{ $row->jenis_pengeluaran }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tgl_pengeluaran)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($row->biaya, 0, ',', '.') }}</td>
                    <td>{{ $row->keterangan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="summary">
        <p>Total Pengeluaran: Rp {{ number_format($totalBiaya, 0, ',', '.') }}</p>
    </div>
</body>

</html>
