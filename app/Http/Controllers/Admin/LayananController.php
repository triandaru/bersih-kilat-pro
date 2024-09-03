<?php

namespace App\Http\Controllers\Admin;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        return view('main.admin.layanan.index', [
            "layanans" => $layanans,
            'title' => 'Layanan' // atau teks lain yang sesuai
        ]);
    }

    public function create()
    {
        return view('main.admin.layanan.create', [
            'title' => 'Tambah Data',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'layanan' => 'required|string|max:255',
            'biaya' => 'required|string|max:255', // Validasi sebagai string karena ada pemrosesan khusus untuk biaya
        ]);

        // Ambil data dari request dan proses biaya
        $nama_layanan = $request->input('layanan');
        $biaya = $request->input('biaya');

        // Hilangkan titik sebelum disimpan ke database
        $biaya_layanan = str_replace('.', '', $biaya);

        // Buat instance Layanan dan simpan data
        $layanan = new Layanan();
        $layanan->nama_layanan = $nama_layanan;
        $layanan->biaya = $biaya_layanan;

        // Simpan ke database
        if ($layanan->save()) {
            // Redirect ke halaman layanan dengan pesan sukses
            return redirect()->route('admin.layanan.index')->with('pesan', 'Data berhasil disimpan.');
        } else {
            // Redirect kembali dengan pesan error jika gagal menyimpan
            return redirect()->back()->withErrors('Ada kesalahan saat menyimpan data.');
        }
    }
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('main.admin.layanan.edit', [
            'layanan' => $layanan,
            'title' => 'Laman Edit'
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'layanan' => 'required|string|max:255',
            'biaya' => 'required|string', // Sesuaikan validasi jika perlu
        ]);

        // Cari data layanan berdasarkan id
        $layanan = Layanan::findOrFail($id);

        // Update data layanan
        $layanan->nama_layanan = $request->input('layanan'); // Gunakan 'nama_layanan' sesuai dengan field di database
        $layanan->biaya = str_replace('.', '', $request->input('biaya')); // Hilangkan titik untuk biaya

        // Simpan perubahan ke database
        $layanan->save();

        // Redirect ke halaman layanan dengan pesan sukses
        return redirect()->route('admin.layanan.index')->with('pesan', 'Data berhasil diubah.');
    }

    // Destroy method
    public function destroy($id)
    {
        Layanan::findOrFail($id)->delete();
        return redirect()->route('admin.layanan.index')->with('pesan', 'Kategori berhasil dihapus.');
    }
}
