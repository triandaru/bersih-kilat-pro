@extends('layout.navbar')

@section('content')
    <div class="container-fluid">
        <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clipboard-list fa-fw mr-2"></i>Transaksi</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Entri Data Transaksi</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.transaksi.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>ID Transaksi <span class="text-danger">*</span></label>
                                <input type="text" name="id_transaksi" class="form-control" value="{{ $idTransaksi }}"
                                    readonly>
                            </div>
                        </div>

                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label>Tanggal <span class="text-danger">*</span></label>
                                <input type="text" name="tanggal" class="form-control date-picker"
                                    data-date-format="yyyy-mm-dd" autocomplete="off" value="{{ now()->format('Y-m-d') }}"
                                    required>
                                <div class="invalid-feedback">Tanggal tidak boleh kosong.</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 mb-4">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nama Pelanggan <span class="text-danger">*</span></label>
                                <input type="text" name="nama_pelanggan" class="form-control" autocomplete="off"
                                    required>
                                <div class="invalid-feedback">Nama pelanggan tidak boleh kosong.</div>
                            </div>
                        </div>

                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label>Plat Nomor Kendaraan <span class="text-danger">*</span></label>
                                <input type="text" name="no_kendaraan" class="form-control text-uppercase"
                                    autocomplete="off" required>
                                <div class="invalid-feedback">Plat nomor kendaraan tidak boleh kosong.</div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-3 mb-4">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Layanan <span class="text-danger">*</span></label>
                                <select id="layanan" name="layanan" class="form-control" autocomplete="off" required>
                                    <option selected disabled value="">-- Pilih --</option>
                                    @foreach ($layanan as $data)
                                        <option value="{{ $data->id_layanan }}" data-biaya="{{ $data->biaya }}">
                                            {{ $data->nama_layanan }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Layanan tidak boleh kosong.</div>
                            </div>
                        </div>

                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label>Biaya <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">Rp.</span></div>
                                    <input type="text" id="biaya" name="biaya" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5">

                    <div class="form-group pt-3">
                        <input type="submit" name="simpan" value="simpan" class="btn btn-info pl-4 pr-4 mr-2">
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary pl-4 pr-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const layananSelect = document.getElementById('layanan');
            const biayaInput = document.getElementById('biaya');

            layananSelect.addEventListener('change', function() {
                // Ambil opsi yang dipilih
                const selectedOption = layananSelect.options[layananSelect.selectedIndex];

                // Ambil data-biaya dari opsi yang dipilih
                const biaya = selectedOption.getAttribute('data-biaya');

                // Update input biaya
                biayaInput.value = biaya ? biaya : '';
            });
        });
    </script>
@endsection
