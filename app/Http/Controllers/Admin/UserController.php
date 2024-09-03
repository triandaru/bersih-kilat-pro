<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\HakAkses;
use App\Models\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    // public function index()
    // {
    //     $user = User::all();
    //     return view('main.admin.manajemen_user.index', [
    //         "users" => $user,
    //         'title' => 'Layanan' // atau teks lain yang sesuai
    //     ]);
    // }

    public function index()
    {
        $users = User::with('akses')->orderBy('id_user', 'desc')->get();
        return view('main.admin.manajemen_user.index', compact('users'));
    }

    public function create(Request $request)
    {
        // Mengambil layanan dari database
        $akses = HakAkses::orderBy('nama_akses', 'asc')->get();


        return view('main.admin.manajemen_user.create', compact('akses'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'akses' => 'required|exists:hak_akses,id_akses',
        ]);

        // Simpan data ke database
        User::create([
            'nama_user' => $validatedData['nama_user'],
            'username' => $validatedData['username'],
            'password' => bcrypt($validatedData['password']), // Enkripsi password
            'akses' => $validatedData['akses'],
        ]);

        // Redirect atau beri pesan sukses
        return redirect()->route('admin.manajemen_user.index')->with('success', 'Data user berhasil disimpan.');
    }

    public function edit($id)
    {
        // Ambil data user dan hak akses
        $user = User::findOrFail($id);
        $akses = HakAkses::all();

        return view('main.admin.manajemen_user.edit', compact('user', 'akses'));
    }

    public function update(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_user' => 'required|exists:users,id_user',
            'nama_user' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->id_user . ',id_user',
            'password' => 'nullable|string|min:8',
            'hak_akses' => 'required|exists:hak_akses,id_akses',
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($validatedData['id_user']);

        // Update data user
        $user->update([
            'nama_user' => $validatedData['nama_user'],
            'username' => $validatedData['username'],
            'password' => $request->password ? bcrypt($validatedData['password']) : $user->password, // Hanya enkripsi password jika diubah
            'id_akses' => $validatedData['hak_akses'],
        ]);

        // Redirect atau beri pesan sukses
        return redirect()->route('admin.manajemen_user.index')->with('success', 'Data user berhasil diubah.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.manajemen_user.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
