<?php

namespace App\Http\Controllers\Admin;

use Dompdf\Dompdf;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function index()
    {
        return view('main.admin.laporan.index');
    }

    public function cetak(Request $request)
    {
        // Validasi input
        $request->validate([
            'tanggal_awal' => 'required|date_format:d-m-Y',
            'tanggal_akhir' => 'required|date_format:d-m-Y',
        ]);

        // Format tanggal
        $tanggal_awal = date('Y-m-d', strtotime($request->input('tanggal_awal')));
        $tanggal_akhir = date('Y-m-d', strtotime($request->input('tanggal_akhir')));

        // Ambil data dari database
        $data = DB::table('transaksis as a')
            ->join('layanans as b', 'a.layanan', '=', 'b.id_layanan')
            ->select('a.id_transaksi', 'a.tanggal', 'a.nama_pelanggan', 'a.no_kendaraan', 'a.layanan', 'a.total_biaya', 'b.nama_layanan')
            ->whereBetween('a.tanggal', [$tanggal_awal, $tanggal_akhir])
            ->orderBy('a.id_transaksi', 'asc')
            ->get();

        // Set up Dompdf
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setIsRemoteEnabled(true);
        $dompdf->setOptions($options);

        // Buat HTML untuk PDF
        $html = view('main.admin.laporan.cetak', [
            'data' => $data,
            'tanggal_awal' => $request->input('tanggal_awal'),
            'tanggal_akhir' => $request->input('tanggal_akhir')
        ])->render();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();

        // Stream PDF
        return $dompdf->stream('Laporan-Data-Transaksi.pdf', ['Attachment' => 0]);
    }
}
