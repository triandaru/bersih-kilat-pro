<?php

namespace App\Http\Controllers\User;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua nama layanan
        $layanan = Layanan::with('transaksis')
            ->leftJoin('transaksis', 'layanans.id_layanan', '=', 'transaksis.layanan')
            ->selectRaw('layanans.nama_layanan, SUM(transaksis.total_biaya) as total_pendapatan')
            ->groupBy('layanans.id_layanan')
            ->get();

        $totallayanan = Layanan::leftJoin('transaksis', 'layanans.id_layanan', '=', 'transaksis.layanan')
            ->selectRaw('layanans.nama_layanan, COUNT(transaksis.id_transaksi) as jumlah')
            ->groupBy('layanans.id_layanan')
            ->get();

        // Ekstrak data menjadi array untuk digunakan di view
        $namaLayanan = $layanan->pluck('nama_layanan')->toArray();
        $totalPendapatanPerLayanan = $layanan->pluck('total_pendapatan')->toArray();

        // Menghitung jumlah transaksi per layanan
        $jumlahTransaksiPerLayanan = $totallayanan->pluck('jumlah')->toArray();

        return view('main.user.dashboard', compact('namaLayanan', 'totalPendapatanPerLayanan', 'jumlahTransaksiPerLayanan'));
    }
}
