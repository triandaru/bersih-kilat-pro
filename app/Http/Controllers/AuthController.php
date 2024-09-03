<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        $data['title'] = 'Login';
        return view('login', $data);
    }

    public function authenticationLogin(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // Ambil data pengguna berdasarkan username
        $user = User::where('username', $request->input('username'))->first();

        // Cek jika pengguna ditemukan
        if ($user) {
            // Jika password benar
            if (Hash::check($request->input('password'), $user->password)) {
                // Simpan id_user ke dalam session
                $request->session()->put('id_user', $user->id_user);
                $request->session()->put('id_akses', $user->akses);

                // Cek id_Akses dan arahkan pengguna
                if ($user->akses == 1) {
                    return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di menu Admin'); // Ubah dengan route yang sesuai
                } elseif ($user->akses == 2) {
                    return redirect()->route('user.dashboard')->with('success', 'Selamat datang di menu User');  // Ubah dengan route yang sesuai
                } else {
                    return redirect()->back()->withErrors(['error' => 'Akses tidak dikenali']);
                }
            } else {
                // Jika password salah
                return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Login Gagal']);
            }
        } else {
            // Jika pengguna tidak ditemukan
            return redirect()->back()->withInput($request->all())->withErrors(['error' => 'Akun tidak ditemukan']);
        }
    }

    public function logout(Request $request)
    {
        // Hapus id_user dan id_role dari session
        $request->session()->forget('id_user');
        $request->session()->forget('id_akses');

        // Mengarahkan pengguna ke halaman login setelah logout
        return redirect('/login');
    }
}
