<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Laporan Supplier Performance</h2>

    <table class="table-auto w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">#</th>
                <th class="border px-4 py-2">Nama Supplier</th>
                <th class="border px-4 py-2">Total Supply</th>
                <th class="border px-4 py-2">Barang Rusak</th>
                <th class="border px-4 py-2">Return</th>
                <th class="border px-4 py-2">Efisiensi (%)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporan as $index => $row)
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $row['nama_supplier'] }}</td>
                    <td class="border px-4 py-2">{{ $row['total_supply'] }}</td>
                    <td class="border px-4 py-2">{{ $row['total_rusak'] }}</td>
                    <td class="border px-4 py-2">{{ $row['total_return'] }}</td>
                    <td class="border px-4 py-2">{{ $row['efisiensi'] }} %</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-6">
        <a href="{{ route('laporan-supplier.pdf') }}" target="_blank" class="px-4 py-2 bg-red-600 text-white rounded">
            📄 Cetak PDF
        </a>
    </div>
</x-filament::page>
