@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Dokumentasi')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper mt-2">
    <!-- Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Dashboard Informasi Dokumentasi</h1>
                    </div>
                    <div class="card-body">

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <div class="card text-bg-primary shadow-sm">
                                    <div class="card-body">
                                        <h6>Total Permohonan</h6>
                                        <h3>320</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-success shadow-sm">
                                    <div class="card-body">
                                        <h6>Selesai</h6>
                                        <h3>250</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-warning shadow-sm">
                                    <div class="card-body">
                                        <h6>Proses</h6>
                                        <h3>50</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card text-bg-danger shadow-sm">
                                    <div class="card-body">
                                        <h6>Pending</h6>
                                        <h3>20</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Jenis Dokumentasi</h6>
                                        <canvas id="typeChart"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-body">
                                        <h6 class="card-title">Status Permohonan</h6>
                                        <canvas id="statusChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h6 class="card-title">Daftar Layanan Dokumentasi Terbaru</h6>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered align-middle">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pemohon</th>
                                                <th>Jenis Dokumentasi</th>
                                                <th>Status</th>
                                                <th>Tanggal Permohonan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Dicky Agusputra</td>
                                                <td>Foto Kegiatan</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
                                                <td>10-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Firmansyah</td>
                                                <td>Video Dokumentasi</td>
                                                <td><span class="badge bg-warning">Proses</span></td>
                                                <td>12-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Fahmi Imaniar</td>
                                                <td>Laporan Dokumentasi</td>
                                                <td><span class="badge bg-danger">Pending</span></td>
                                                <td>13-09-2025</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>L Noer Fahmi Tamar</td>
                                                <td>Foto Kegiatan</td>
                                                <td><span class="badge bg-success">Selesai</span></td>
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
    new Chart(document.getElementById('typeChart'), {
        type: 'doughnut',
        data: {
            labels: ['Foto Kegiatan', 'Video Dokumentasi', 'Laporan Dokumentasi'],
            datasets: [{
                data: [150, 100, 70],
                backgroundColor: ['#0d6efd', '#198754', '#ffc107']
            }]
        }
    });

    new Chart(document.getElementById('statusChart'), {
        type: 'bar',
        data: {
            labels: ['Selesai', 'Proses', 'Pending'],
            datasets: [{
                label: 'Jumlah Permohonan',
                data: [250, 50, 20],
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