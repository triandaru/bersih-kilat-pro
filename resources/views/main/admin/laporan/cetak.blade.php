<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Transaksi</title>
    <link href="{{ public_path('assets/css/laporan.css') }}" rel="stylesheet">
</head>

<body class="text-dark">
    <div class="text-center">
        <h4>LAPORAN DATA TRANSAKSI</h4>
        <span>Tanggal {{ $tanggal_awal }} s.d. {{ $tanggal_akhir }}</span>
    </div>
    <hr>
    <div class="mt-4">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead class="bg-info text-white text-center">
                <tr>
                    <th>No.</th>
                    <th>ID Transaksi</th>
                    <th>Tanggal</th>
                    <th>Nama Pelanggan</th>
                    <th>Plat Nomor</th>
                    <th>Layanan</th>
                    <th>Total Biaya</th>
                </tr>
            </thead>
            <tbody class="text-dark">
                @php
                    $no = 1;
                    $total_pendapatan = 0;
                @endphp
                @foreach ($data as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $item->id_transaksi }}</td>
                        <td class="text-center">{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                        <td>{{ $item->nama_pelanggan }}</td>
                        <td class="text-center">{{ $item->plat_nomor_kendaraan }}</td>
                        <td>{{ $item->nama_layanan }}</td>
                        <td class="text-right">Rp. {{ number_format($item->total_biaya, 0, '', '.') }}</td>
                    </tr>
                    @php
                        $total_pendapatan += $item->total_biaya;
                    @endphp
                @endforeach
                <tr>
                    <td class="text-center font-weight-bold" colspan="6">Total Pendapatan</td>
                    <td class="text-right font-weight-bold">Rp. {{ number_format($total_pendapatan, 0, '', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="text-right mt-5">..................., {{ date('d-m-Y') }}</div>
</body>

</html>
