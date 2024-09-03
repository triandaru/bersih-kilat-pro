@extends('layout.navbar')
@section('content')
    <div class="container-fluid">
        <!-- Judul halaman -->
        <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clone fa-fw mr-2"></i>Layanan</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Judul form -->
                <h6 class="m-0 font-weight-bold">Ubah Data Layanan</h6>
            </div>
            <div class="card-body">
                <!-- Form ubah data -->
                <form action="{{ route('admin.layanan.update', $layanan->id_layanan) }}" method="POST"
                    class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')

                    <!-- Input hidden untuk ID layanan -->
                    <input type="hidden" name="id_layanan" value="{{ $layanan->id_layanan }}">

                    <div class="form-group col-lg-5 pl-0">
                        <label>Nama Layanan <span class="text-danger">*</span></label>
                        <input type="text" name="layanan" class="form-control @error('layanan') is-invalid @enderror"
                            autocomplete="off" value="{{ old('layanan', $layanan->nama_layanan) }}" required>
                        @error('layanan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @else
                            <div class="invalid-feedback">Nama layanan tidak boleh kosong.</div>
                        @enderror
                    </div>

                    <div class="form-group col-lg-5 pl-0">
                        <label>Biaya <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                            <input type="text" name="biaya"
                                class="form-control mask_money @error('biaya') is-invalid @enderror" autocomplete="off"
                                value="{{ old('biaya', number_format($layanan->biaya, 0, '', '.')) }}" required>
                            @error('biaya')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback">Biaya tidak boleh kosong.</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="mt-5">

                    <div class="form-group pt-3">
                        <!-- Tombol simpan data -->
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-info pl-4 pr-4 mr-2">
                        <!-- Tombol kembali ke halaman tampil data -->
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary pl-4 pr-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
