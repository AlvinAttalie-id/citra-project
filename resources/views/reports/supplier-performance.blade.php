<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Supplier Performance</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Laporan Supplier Performance</h2>
    <table>
        <thead>
            <tr>
                <th>Supplier</th>
                <th>Total Supply</th>
                <th>Barang Rusak</th>
                <th>Barang Return</th>
                <th>Efisiensi (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $row)
                <tr>
                    <td>{{ $row['supplier'] }}</td>
                    <td>{{ $row['total_supply'] }}</td>
                    <td>{{ $row['total_rusak'] }}</td>
                    <td>{{ $row['total_return'] }}</td>
                    <td>{{ $row['efisiensi'] }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
