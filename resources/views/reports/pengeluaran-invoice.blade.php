<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Pengeluaran</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { margin-bottom: 20px; }
        .title { font-size: 20px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        td, th { padding: 8px; border: 1px solid #ddd; }
        .right { text-align: right; }
        .total { font-size: 16px; font-weight: bold; }
    </style>
</head>

<body>

<div class="header">
    <div class="title">INVOICE PENGELUARAN</div>
    <div>No: {{ $record->slug }}</div>
    <div>Tanggal: {{ $record->tgl_pengeluaran->format('d F Y') }}</div>
</div>

<table>
    <tr>
        <th>Jenis</th>
        <td>{{ $record->jenis_pengeluaran }}</td>
    </tr>

    <tr>
        <th>Keterangan</th>
        <td>{{ $record->keterangan }}</td>
    </tr>

    <tr>
        <th>Bukti</th>
        <td>{{ $record->bukti }}</td>
    </tr>

    <tr>
        <th>Total</th>
        <td class="right total">
            Rp {{ number_format($record->biaya, 0, ',', '.') }}
        </td>
    </tr>
</table>

</body>
</html>
