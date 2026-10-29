@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Berusaha')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper mt-2">
    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Dashboard Informasi Berusaha</h1>
                    </div>
                    <div class="card-body">

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card text-bg-primary shadow-sm">
                                    <div class="card-body">
                                        <h6>Total Izin</h6>
                                        <h3>1.250</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-success shadow-sm">
                                    <div class="card-body">
                                        <h6>Izin UMKM</h6>
                                        <h3>850</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-warning shadow-sm">
                                    <div class="card-body">
                                        <h6>Izin Perusahaan Besar</h6>
                                        <h3>300</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-danger shadow-sm">
                                    <div class="card-body">
                                        <h6>Ditolak</h6>
                                        <h3>100</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Grafik -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Jenis Perizinan</h6>
                                        <canvas id="permitTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Tren Pengajuan Izin per Bulan</h6>
                                        <canvas id="permitTrendChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Status Perizinan</h6>
                                        <canvas id="permitStatusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Daftar Pengajuan Izin Terbaru</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pemohon</th>
                                                <th>Jenis Izin</th>
                                                <th>Status</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>CV Sukses Abadi</td>
                                                <td>Izin Usaha Dagang</td>
                                                <td><span class="badge bg-success">Disetujui</span></td>
                                                <td>12-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>PT Mega Jaya</td>
                                                <td>Izin Pabrik</td>
                                                <td><span class="badge bg-warning">Proses</span></td>
                                                <td>11-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>UD Maju Bersama</td>
                                                <td>Izin Restoran</td>
                                                <td><span class="badge bg-danger">Ditolak</span></td>
                                                <td>10-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>PT Nusantara</td>
                                                <td>Izin Transportasi</td>
                                                <td><span class="badge bg-success">Disetujui</span></td>
                                                <td>09-09-2025</td>
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

<!-- / Content -->
@endsection

@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('permitTypeChart'), {
        type: 'doughnut',
        data: {
            labels: ['UMKM', 'Perusahaan Besar', 'Lainnya'],
            datasets: [{
                data: [850, 300, 100],
                backgroundColor: ['#198754', '#ffc107', '#0d6efd']
            }]
        }
    });

    new Chart(document.getElementById('permitTrendChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                label: 'Jumlah Pengajuan',
                data: [90, 120, 150, 200, 180, 210, 250, 230, 300],
                borderColor: '#0d6efd',
                backgroundColor: '#0d6efd',
                tension: 0.3
            }]
        }
    });

    new Chart(document.getElementById('permitStatusChart'), {
        type: 'bar',
        data: {
            labels: ['Disetujui', 'Proses', 'Ditolak'],
            datasets: [{
                label: 'Jumlah',
                data: [850, 300, 100],
                backgroundColor: ['#198754', '#ffc107', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endpush