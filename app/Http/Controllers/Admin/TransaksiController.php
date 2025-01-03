<?php

namespace App\Http\Controllers\Admin;


use App\Models\Layanan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{

    public function index()
    {
        $title = 'Transaksi - Data Transaksi Per Layanan';

        $transaksis = DB::table('transaksis as bm')
            ->leftJoin('layanans as b', 'bm.layanan', '=', 'b.id_layanan')
            ->select('bm.*', 'b.nama_layanan')
            ->get();

        // $transaksis = Transaksi::with('layanan')->get();
        return view('main.admin.transaksi.index', compact('transaksis', 'title'));
    }

    public function create(Request $request)
    {
        $title = 'Tambah Transaksi';
        // Mengambil layanan dari database
        $layanan = Layanan::orderBy('nama_layanan', 'asc')->get();

        // Mendapatkan ID Transaksi terbaru dan membuat ID baru
        $lastTransaction = Transaksi::latest('id_transaksi')->first();
        $nomorUrut = $lastTransaction ? ((int) $lastTransaction->id_transaksi + 1) : 1;

        // Mengatur nomor urut sebagai id_transaksi
        $idTransaksi = $nomorUrut;

        return view('main.admin.transaksi.create', compact('layanan', 'idTransaksi', 'title'));
    }


    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'id_transaksi' => 'required',
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required|string|max:255',
            'no_kendaraan' => 'required|string|max:255',
            'layanan' => 'required|exists:layanans,id_layanan', // pastikan layanan ada di database
            'biaya' => 'required|numeric',
        ]);

        // Simpan data transaksi ke dalam database
        Transaksi::create([
            'id_transaksi' => $request->id_transaksi,
            'tanggal' => $request->tanggal,
            'nama_pelanggan' => $request->nama_pelanggan,
            'no_kendaraan' => strtoupper($request->no_kendaraan),
            'layanan' => $request->layanan,
            'total_biaya' => $request->biaya,
        ]);

        // Redirect ke halaman transaksi dengan pesan sukses
        return redirect()->route('admin.transaksi.index')->with('pesan', 'Transaksi berhasil ditambahkan!');
    }





    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $layanans = Layanan::all(); // mengambil semua data layanan

        return view('main.admin.transaksi.edit', [
            'transaksi' => $transaksi,
            'layanans' => $layanans,
            'title' => 'Edit Transaksi'
        ]);
    }
    public function update(Request $request, $id_transaksi)
    {
        $request->validate([
            'id_transaksi' => 'required',
            'tanggal' => 'required|date',
            'nama_pelanggan' => 'required',
            'no_kendaraan' => 'required',
            'layanan' => 'required',
            'biaya' => 'required|numeric',
        ]);

        $transaksi = Transaksi::find($id_transaksi);
        $transaksi->tanggal = $request->tanggal;
        $transaksi->nama_pelanggan = $request->nama_pelanggan;
        $transaksi->no_kendaraan = $request->no_kendaraan;
        $transaksi->layanan = $request->layanan;
        $transaksi->total_biaya = $request->biaya;
        $transaksi->save();

        return redirect()->route('admin.transaksi.index')->with('pesan', 'Data transaksi berhasil diubah.');
    }

    public function destroy($id)
    {
        Transaksi::findOrFail($id)->delete();
        return redirect()->route('admin.transaksi.index')->with('pesan', 'Kategori berhasil dihapus.');
    }
}
