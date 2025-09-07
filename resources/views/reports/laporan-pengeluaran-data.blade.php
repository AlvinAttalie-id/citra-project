<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;">Laporan Pengeluaran per Semester</h2>
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Semester</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanSemester as $row)
                <tr>
                    <td>{{ $row['tahun'] }}</td>
                    <td>{{ $row['semester'] }}</td>
                    <td>Rp {{ number_format($row['total_biaya'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 style="text-align: center;">Laporan Pengeluaran per Tahun</h2>
    <table>
        <thead>
            <tr>
                <th>Tahun</th>
                <th>Total Biaya</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanTahunan as $row)
                <tr>
                    <td>{{ $row['tahun'] }}</td>
                    <td>Rp {{ number_format($row['total_biaya'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
