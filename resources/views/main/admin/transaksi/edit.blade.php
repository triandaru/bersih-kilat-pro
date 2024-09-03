@extends('layout.navbar')
@section('content')
    <div class="container-fluid">
        <!-- Judul halaman -->
        <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-clipboard-list fa-fw mr-2"></i>Transaksi</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Judul form -->
                <h6 class="m-0 font-weight-bold">Ubah Data Transaksi</h6>
            </div>
            <div class="card-body">
                <!-- Form ubah data -->
                <form action="{{ route('admin.transaksi.update', $transaksi->id_transaksi) }}" method="post"
                    class="needs-validation" novalidate>

                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>ID Transaksi <span class="text-danger">*</span></label>
                                <input type="text" name="id_transaksi" class="form-control"
                                    value="{{ $transaksi->id_transaksi }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label>Tanggal <span class="text-danger">*</span></label>
                                <input type="text" name="tanggal" class="form-control date-picker"
                                    data-date-format="yyyy-mm-dd" autocomplete="off"
                                    value="{{ date('Y-m-d', strtotime($transaksi->tanggal)) }}" required>
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
                                    value="{{ $transaksi->nama_pelanggan }}" required>
                                <div class="invalid-feedback">Nama pelanggan tidak boleh kosong.</div>
                            </div>
                        </div>

                        <div class="col-md-5 ml-auto">
                            <div class="form-group">
                                <label>Plat Nomor Kendaraan <span class="text-danger">*</span></label>
                                <input type="text" name="no_kendaraan" class="form-control text-uppercase"
                                    autocomplete="off" value="{{ $transaksi->no_kendaraan }}" required>
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
                                    <option value="{{ $transaksi->layanan }}">{{ $transaksi->nama_layanan }}</option>
                                    <option disabled value="">-- Pilih --</option>
                                    @foreach ($layanans as $layanan)
                                        <option value="{{ $layanan->id_layanan }}"
                                            {{ $transaksi->layanan == $layanan->id_layanan ? 'selected' : '' }}>
                                            {{ $layanan->nama_layanan }}
                                        </option>
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
                                    <input type="text" id="biaya" name="biaya" class="form-control"
                                        value="{{ number_format($transaksi->total_biaya, 0, '', '.') }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="mt-5">

                    <div class="form-group pt-3">
                        <!-- Tombol simpan data -->
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-info pl-4 pr-4 mr-2">
                        <!-- Tombol kembali ke halaman tampil data -->
                        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary pl-4 pr-4">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript untuk mengupdate biaya berdasarkan pilihan layanan -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Format tanggal menggunakan date picker
            $('.date-picker').datepicker({
                format: 'yyyy-mm-dd', // pastikan format ini sesuai dengan MySQL
                autoclose: true
            });

            $('#layanan').change(function() {
                var id_layanan = $('#layanan').val();

                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.transaksi.create') }}",
                    data: {
                        id_layanan: id_layanan
                    },
                    dataType: "JSON",
                    success: function(result) {
                        $('#biaya').val(result);
                    }
                });
            });
        });
    </script>
@endsection
