@extends('layout.navbar')

@section('content')
    @php
        use App\Models\User;
        $user = User::with('akses')->where('id_user', session('id_user'))->first();
    @endphp
    <div class="container-fluid">
        <!-- judul halaman -->
        <h1 class="h4 mb-4 text-gray-800"><i class="fas fa-fw fa-tachometer-alt mr-2"></i>Dashboard</h1>

        <!-- menampilkan pesan selamat datang -->
        <div class="alert alert-info alert-dismissible fade show py-3 mb-4" role="alert">
            <i class="fas fa-user mr-2"></i>Selamat datang kembali <strong>{{ $user->nama_user }}</strong> di Aplikasi Jasa
            Cuci Mobil dan Motor. Anda login sebagai <strong>Admin</strong>.
        </div>

        <div class="row">
            <!-- menampilkan informasi jumlah data layanan -->
            <div class="col-lg-3 col-md-12 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-info mb-2">Layanan</div>
                                @php
                                    $jumlah_layanan = \App\Models\Layanan::count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_layanan }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clone fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menampilkan informasi jumlah data transaksi -->
            <div class="col-lg-3 col-md-12 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-warning mb-2">Transaksi</div>
                                @php
                                    $jumlah_transaksi = \App\Models\Transaksi::count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_transaksi }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menampilkan informasi jumlah total pendapatan -->
            <div class="col-lg-3 col-md-12 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-success mb-2">Total Pendapatan</div>
                                @php
                                    $total_pendapatan = \App\Models\Transaksi::sum('total_biaya');
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp.
                                    {{ number_format($total_pendapatan, 0, '', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- menampilkan informasi jumlah data pengguna aplikasi -->
            <div class="col-lg-3 col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="font-weight-bold text-primary mb-2">Pengguna Aplikasi</div>
                                @php
                                    $jumlah_user = \App\Models\User::count();
                                @endphp
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_user }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- grafik total pendapatan per layanan -->
            <div class="col-lg-6 col-md-12 mt-3 mb-5">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <!-- judul grafik -->
                        <h6 class="m-0 font-weight-bold">Total Pendapatan Per Layanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <!-- menampilkan grafik -->
                            <canvas id="grafikPendapatan"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- grafik jumlah transaksi per layanan -->
            <div class="col-lg-6 col-md-12 mt-3 mb-5">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <!-- judul grafik -->
                        <h6 class="m-0 font-weight-bold">Jumlah Transaksi Per Layanan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <!-- menampilkan grafik -->
                            <canvas id="grafikTransaksi"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="<?= url('https://cdn.jsdelivr.net/npm/chart.js') ?>"></script>
    <script>
        // Data dari controller untuk grafik
        var namaLayanan = @json($namaLayanan);
        var totalPendapatanPerLayanan = @json($totalPendapatanPerLayanan);
        var jumlahTransaksiPerLayanan = @json($jumlahTransaksiPerLayanan);

        // Grafik total pendapatan per layanan (Bar Chart)
        var ctx = document.getElementById("grafikPendapatan");
        var grafikPendapatan = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: namaLayanan,
                datasets: [{
                    label: "Total Pendapatan",
                    backgroundColor: ['#36b9cc', '#1cc88a', '#4e73df', '#f6c23e', '#e74a3b'],
                    hoverBackgroundColor: ['#2c9faf', '#17a673', '#2e59d9', '#f4b619', '#e02d1b'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    data: totalPendapatanPerLayanan,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        maxBarThickness: 70,
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ' : Rp. ' + tooltipItem.yLabel;
                        }
                    }
                },
            }
        });

        // Grafik jumlah transaksi per layanan (Pie Chart)
        var ctx2 = document.getElementById("grafikTransaksi");
        var grafikTransaksi = new Chart(ctx2, {
            type: 'doughnut',
            data: {
                labels: namaLayanan,
                datasets: [{
                    data: jumlahTransaksiPerLayanan,
                    backgroundColor: ['#36b9cc', '#1cc88a', '#4e73df', '#f6c23e', '#e74a3b'],
                    hoverBackgroundColor: ['#2c9faf', '#17a673', '#2e59d9', '#f4b619', '#e02d1b'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
@endsection

{{-- @section('scripts')
@endsection --}}
