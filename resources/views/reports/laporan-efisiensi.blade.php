<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Efisiensi Gudang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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
    </style>
</head>

<body>
    <h2>Laporan Efisiensi Gudang</h2>

    <table>
        <tr>
            <th>Total Supply</th>
            <td>{{ $laporan['total_supply'] }}</td>
        </tr>
        <tr>
            <th>Total Keluar</th>
            <td>{{ $laporan['total_keluar'] }}</td>
        </tr>
        <tr>
            <th>Total Return</th>
            <td>{{ $laporan['total_return'] }}</td>
        </tr>
        <tr>
            <th>Total Rusak</th>
            <td>{{ $laporan['total_rusak'] }}</td>
        </tr>
        <tr>
            <th>Total Keluar Bersih</th>
            <td>{{ $laporan['total_keluar_bersih'] }}</td>
        </tr>
        <tr>
            <th>Efisiensi (%)</th>
            <td>{{ $laporan['efisiensi'] }} %</td>
        </tr>
        <tr>
            <th>Total Pengeluaran</th>
            <td>Rp {{ number_format($laporan['total_pengeluaran'], 0, ',', '.') }}</td>
        </tr>
    </table>
</body>

</html>
