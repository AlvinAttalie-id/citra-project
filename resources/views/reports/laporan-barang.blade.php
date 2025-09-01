<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk dan Keluar</title>
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
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #eee;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Barang Masuk dan Keluar</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
                <th>Selisih</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $row)
                <tr>
                    <td>{{ $row['kode_barang'] }}</td>
                    <td>{{ $row['jenis_barang'] }}</td>
                    <td>{{ $row['total_masuk'] }}</td>
                    <td>{{ $row['total_keluar'] }}</td>
                    <td>{{ $row['selisih'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
