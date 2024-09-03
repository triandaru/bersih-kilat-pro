@extends('layout.navbar')

@section('content')
    <div class="container-fluid">
        <!-- judul halaman -->
        <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-user fa-fw mr-2"></i>Manajemen User</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- judul form -->
                <h6 class="m-0 font-weight-bold">Ubah Data User</h6>
            </div>
            <div class="card-body">
                <!-- form ubah data -->
                <form action="{{ route('admin.manajemen_user.update', ['id_user' => $user->id_user]) }}" method="post"
                    class="needs-validation" novalidate>

                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_user" value="{{ $user->id_user }}">

                    <div class="form-group">
                        <label>Nama User <span class="text-danger">*</span></label>
                        <input type="text" name="nama_user" class="form-control col-lg-5" autocomplete="off"
                            value="{{ old('nama_user', $user->nama_user) }}" required>
                        <div class="invalid-feedback">Nama user tidak boleh kosong.</div>
                    </div>

                    <div class="form-group">
                        <label>Username <span class="text-danger">*</span></label>
                        <input type="text" name="username" class="form-control col-lg-5" autocomplete="off"
                            value="{{ old('username', $user->username) }}" required>
                        <div class="invalid-feedback">Username tidak boleh kosong.</div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control col-lg-5"
                            placeholder="Kosongkan password jika tidak diubah" autocomplete="off">
                        <div class="invalid-feedback">Password tidak boleh kosong.</div>
                    </div>

                    <div class="form-group">
                        <label>Hak Akses <span class="text-danger">*</span></label>
                        <select name="hak_akses" class="form-control col-lg-5" autocomplete="off" required>
                            @if ($akses->where('id_akses', $user->id_akses)->first())
                                <option value="{{ $user->id_akses }}">
                                    {{ $akses->where('id_akses', $user->id_akses)->first()->nama_akses }}
                                </option>
                            @else
                                <option disabled value="">-- Pilih --</option>
                            @endif
                            @foreach ($akses as $data)
                                <option value="{{ $data->id_akses }}">{{ $data->nama_akses }}</option>
                            @endforeach
                        </select>


                        <div class="invalid-feedback">Hak akses tidak boleh kosong.</div>
                    </div>

                    <hr class="mt-5">

                    <div class="form-group pt-3">
                        <!-- tombol simpan data -->
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-info pl-4 pr-4 mr-2">
                        <!-- tombol kembali ke halaman tampil data -->
                        <a href="{{ route('admin.manajemen_user.index') }}" class="btn btn-secondary pl-4 pr-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
