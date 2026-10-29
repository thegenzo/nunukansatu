@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Pengaduan')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper mt-2">
    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Dashboard Informasi Pengaduan</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="card shadow mb-2">
                                    <div class="card-body">
                                        <h3>Tren Pengaduan Per Bulan</h3>
                                        <canvas id="trendChart" height="80%"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3>Pengaduan Per Kategori</h3>
                                        <canvas id="categoryChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3>Tabel Laporan</h3>
                                        <table id="laporanTable" class="table table-bordered table-hover align-middle">
                                            <thead class="table-success text-center">
                                                <tr>
                                                    <th>Kategori</th>
                                                    <th>Status Terbalas</th>
                                                    <th>Status Respon</th>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-center">
                                                <tr>
                                                    <td>Fasilitas</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-success">Cepat</span></td>
                                                    <td>120</td>
                                                </tr>
                                                <tr>
                                                    <td>Pelayanan</td>
                                                    <td><span class="badge bg-warning text-dark">Belum</span></td>
                                                    <td><span class="badge bg-danger">Lambat</span></td>
                                                    <td>90</td>
                                                </tr>
                                                <tr>
                                                    <td>Keamanan</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-warning text-dark">Sedang</span></td>
                                                    <td>60</td>
                                                </tr>
                                                <tr>
                                                    <td>Lingkungan</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-success">Cepat</span></td>
                                                    <td>80</td>
                                                </tr>
                                                <tr>
                                                    <td>Lainnya</td>
                                                    <td><span class="badge bg-warning text-dark">Belum</span></td>
                                                    <td><span class="badge bg-danger">Lambat</span></td>
                                                    <td>40</td>
                                                </tr>
                                                <!-- Tambahan data dummy -->
                                                <tr>
                                                    <td>Transportasi</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-warning text-dark">Sedang</span></td>
                                                    <td>55</td>
                                                </tr>
                                                <tr>
                                                    <td>Kebersihan</td>
                                                    <td><span class="badge bg-warning text-dark">Belum</span></td>
                                                    <td><span class="badge bg-danger">Lambat</span></td>
                                                    <td>70</td>
                                                </tr>
                                                <tr>
                                                    <td>Teknologi</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-success">Cepat</span></td>
                                                    <td>95</td>
                                                </tr>
                                                <tr>
                                                    <td>Administrasi</td>
                                                    <td><span class="badge bg-success">Sudah</span></td>
                                                    <td><span class="badge bg-success">Cepat</span></td>
                                                    <td>110</td>
                                                </tr>
                                                <tr>
                                                    <td>Kesehatan</td>
                                                    <td><span class="badge bg-warning text-dark">Belum</span></td>
                                                    <td><span class="badge bg-warning text-dark">Sedang</span></td>
                                                    <td>85</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- / Content -->
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: [30, 45, 25, 60, 70, 55, 40, 65],
                borderColor: '#9C27B0',
                fill: false,
                tension: 0.3
            }]
        }
    });

    const categoryCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(categoryCtx, {
        type: 'bar',
        data: {
            labels: ['Fasilitas', 'Pelayanan', 'Keamanan', 'Lingkungan', 'Lainnya'],
            datasets: [{
                label: 'Jumlah Pengaduan',
                data: [120, 90, 60, 80, 40],
                backgroundColor: '#36A2EB'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endpush