<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAkses
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login dengan memeriksa session
        if (!$request->session()->has('id_akses')) {
            return redirect('/login')->withErrors('Anda harus login terlebih dahulu.');
        }

        $id_role = $request->session()->get('id_akses');

        // Cek role berdasarkan session
        if ($id_role == 1) {
            if ($role == 'admin' && $id_role != 1) {
                return redirect('/user/dashboard')->withErrors('Anda tidak memiliki hak akses sebagai owner.');
            }
        }

        if ($id_role == 2) {
            if ($role == 'user' && $id_role != 2) {
                return redirect('/admin/dashboard')->withErrors('Anda tidak memiliki hak akses sebagai kasir.');
            }
        }

        return $next($request);
    }
}
