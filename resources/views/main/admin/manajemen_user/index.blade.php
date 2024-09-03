@extends('layout.navbar')

@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <!-- judul halaman -->
            <h1 class="h4 mb-0 text-gray-800"><i class="fas fa-user fa-fw mr-2"></i>Manajemen User</h1>
            <!-- tombol entri data -->
            <a href="{{ route('admin.manajemen_user.create') }}" class="btn btn-info btn-icon-split">
                <span class="icon"><i class="fas fa-plus-circle"></i></span>
                <span class="text">Entri Data</span>
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-check-circle mr-1"></i> Sukses!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-times-circle mr-1"></i> Gagal!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- judul tabel -->
                <h6 class="m-0 font-weight-bold">Data User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- tabel untuk menampilkan data dari database -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Nama User</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Hak Akses</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $user->nama_user }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->akses }}</td>
                                    <td class="text-center">
                                        <div>
                                            <!-- tombol ubah data -->
                                            <a href="{{ route('admin.manajemen_user.edit', $user->id_user) }}"
                                                class="btn btn-info btn-circle btn-sm mr-md-1" data-toggle="tooltip"
                                                data-placement="top" title="Ubah">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- tombol hapus data -->
                                            {{-- <form action="{{ route('admin.manajemen_user.destroy', $user->id_user) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Anda yakin ingin menghapus data user dengan username {{ $user->username }}?')"
                                                    class="btn btn-danger btn-circle btn-sm" data-toggle="tooltip"
                                                    data-placement="top" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form> --}}
                                            <button type="button" class="btn btn-danger btn-circle btn-sm"
                                                data-toggle="modal" data-target="#hapusModal{{ $user->id_user }}"
                                                data-placement="top" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="hapusModal{{ $user->id_user }}" tabindex="-1" role="dialog"
                                    aria-labelledby="hapusModalLabel{{ $user->id_user }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel{{ $user->id_user }}"><i
                                                        class="fas fa-trash-alt fa-fw mr-1"></i>Konfirmasi Hapus</h5>
                                                <button class="close" type="button" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data transaksi
                                                <strong>{{ $user->nama_user }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button"
                                                    data-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.manajemen_user.destroy', $user->id_user) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
