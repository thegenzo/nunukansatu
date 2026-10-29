@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Pajak dan Retribusi')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper mt-2">
    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Dashboard Informasi Pajak dan Retribusi</h1>
                    </div>
                    <div class="card-body">

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card text-bg-primary shadow-sm">
                                    <div class="card-body">
                                        <h6>Total Pajak</h6>
                                        <h3>Rp 12,5 M</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-success shadow-sm">
                                    <div class="card-body">
                                        <h6>Total Retribusi</h6>
                                        <h3>Rp 4,3 M</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-warning shadow-sm">
                                    <div class="card-body">
                                        <h6>Sudah Dibayar</h6>
                                        <h3>85%</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-danger shadow-sm">
                                    <div class="card-body">
                                        <h6>Tunggakan</h6>
                                        <h3>Rp 1,2 M</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Jenis Pajak</h6>
                                        <canvas id="taxTypeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Tren Pajak & Retribusi per Bulan</h6>
                                        <canvas id="trendChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Perbandingan Pajak & Retribusi</h6>
                                        <canvas id="comparisonChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Realisasi vs Target</h6>
                                        <canvas id="realizationChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Daftar Wajib Pajak & Retribusi Terbaru</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Wajib Pajak</th>
                                                <th>Jenis</th>
                                                <th>Status</th>
                                                <th>Jumlah</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>PT Maju Jaya</td>
                                                <td>Pajak Hotel</td>
                                                <td><span class="badge bg-success">Lunas</span></td>
                                                <td>Rp 150.000.000</td>
                                                <td>10-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>CV Sejahtera</td>
                                                <td>Retribusi Pasar</td>
                                                <td><span class="badge bg-warning">Proses</span></td>
                                                <td>Rp 25.000.000</td>
                                                <td>12-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>UD Mandiri</td>
                                                <td>Pajak Restoran</td>
                                                <td><span class="badge bg-danger">Tunggakan</span></td>
                                                <td>Rp 50.000.000</td>
                                                <td>13-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>PT Nusantara</td>
                                                <td>Pajak Hiburan</td>
                                                <td><span class="badge bg-success">Lunas</span></td>
                                                <td>Rp 75.000.000</td>
                                                <td>14-09-2025</td>
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

    new Chart(document.getElementById('taxTypeChart'), {
        type: 'doughnut',
        data: {
            labels: ['Pajak Hotel', 'Pajak Restoran', 'Pajak Hiburan', 'Pajak Reklame', 'Pajak Lainnya'],
            datasets: [{
                data: [3000, 2500, 2000, 1500, 1500],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#dc3545', '#6f42c1']
            }]
        }
    });

    new Chart(document.getElementById('trendChart'), {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep'],
            datasets: [{
                    label: 'Pajak',
                    data: [900, 1000, 1100, 1200, 1250, 1300, 1350, 1400, 1450],
                    borderColor: '#0d6efd',
                    backgroundColor: '#0d6efd',
                    tension: 0.3
                },
                {
                    label: 'Retribusi',
                    data: [300, 350, 400, 420, 430, 450, 460, 470, 480],
                    borderColor: '#198754',
                    backgroundColor: '#198754',
                    tension: 0.3
                }
            ]
        }
    });

    new Chart(document.getElementById('comparisonChart'), {
        type: 'bar',
        data: {
            labels: ['Pajak', 'Retribusi'],
            datasets: [{
                label: 'Miliar Rupiah',
                data: [12.5, 4.3],
                backgroundColor: ['#0d6efd', '#198754']
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

    new Chart(document.getElementById('realizationChart'), {
        type: 'bar',
        data: {
            labels: ['Pajak', 'Retribusi'],
            datasets: [{
                    label: 'Target',
                    data: [15000, 5000],
                    backgroundColor: '#ffc107'
                },
                {
                    label: 'Realisasi',
                    data: [12500, 4300],
                    backgroundColor: '#198754'
                }
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endpush