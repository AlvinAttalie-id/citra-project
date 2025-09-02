<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang</title>
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

        .ready {
            color: green;
            font-weight: bold;
        }

        .not-ready {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h2>Laporan Stok Barang</h2>
    <table>
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Jenis Barang</th>
                <th>Jumlah Stok</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $item)
                <tr>
                    <td>{{ $item['kode_barang'] }}</td>
                    <td>{{ $item['jenis_barang'] }}</td>
                    <td>{{ $item['jumlah_stok'] }}</td>
                    <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                    <td class="{{ $item['status'] === 'Ready' ? 'ready' : 'not-ready' }}">
                        {{ $item['status'] }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
