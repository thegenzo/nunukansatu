@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Sektor Pendidikan')

@push('style')
<style>
    canvas {
        width: 100% !important;
        height: 300px !important;
    }
</style>
@endpush

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-fluid">
        <div class="row my-4">
            <div class="col-md-3">
                <div class="card text-center shadow-sm p-3">
                    <h5>Total Sekolah</h5>
                    <h3 class="text-primary">120</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm p-3">
                    <h5>Total Guru</h5>
                    <h3 class="text-success">850</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm p-3">
                    <h5>Total Siswa</h5>
                    <h3 class="text-warning">12,500</h3>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-center shadow-sm p-3">
                    <h5>Mahasiswa</h5>
                    <h3 class="text-danger">3,200</h3>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            </h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3>Distribusi Pendidikan</h3>
                                        <canvas id="eduPie"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3>Jumlah Guru dan Jenjang</h3>
                                        <canvas id="teacherBar"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <h3>Tren Siswa Per Tahun</h3>
                                        <canvas id="studentLine"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card shadow-sm mt-4">
                    <div class="card-body">
                        <h5 class="mb-3">📑 Ringkasan Data Sekolah</h5>
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Nama Sekolah</th>
                                    <th>Jenjang</th>
                                    <th>Jumlah Guru</th>
                                    <th>Jumlah Siswa</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr>
                                    <td>SD Negeri 1 Nunukan</td>
                                    <td>SD</td>
                                    <td>25</td>
                                    <td>450</td>
                                </tr>
                                <tr>
                                    <td>SMP Negeri 2 Nunukan</td>
                                    <td>SMP</td>
                                    <td>30</td>
                                    <td>600</td>
                                </tr>
                                <tr>
                                    <td>SMA Negeri 3 Nunukan</td>
                                    <td>SMA</td>
                                    <td>45</td>
                                    <td>800</td>
                                </tr>
                                <tr>
                                    <td>Universitas Kaltimtara</td>
                                    <td>Perguruan Tinggi</td>
                                    <td>150</td>
                                    <td>3,200</td>
                                </tr>
                            </tbody>
                        </table>
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
    
    new Chart(document.getElementById('eduPie'), {
      type: 'pie',
      data: {
        labels: ['SD', 'SMP', 'SMA', 'Perguruan Tinggi'],
        datasets: [{
          data: [5000, 3500, 2800, 3200],
          backgroundColor: ['#36A2EB', '#FFCE56', '#4CAF50', '#E91E63']
        }]
      }
    });

    new Chart(document.getElementById('teacherBar'), {
      type: 'bar',
      data: {
        labels: ['SD', 'SMP', 'SMA', 'Perguruan Tinggi'],
        datasets: [{
          label: 'Jumlah Guru',
          data: [300, 200, 200, 150],
          backgroundColor: '#2196F3'
        }]
      },
      options: { scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('studentLine'), {
      type: 'line',
      data: {
        labels: ['2019', '2020', '2021', '2022', '2023'],
        datasets: [{
          label: 'Jumlah Siswa',
          data: [10000, 10800, 11500, 12000, 12500],
          borderColor: '#FF9800',
          tension: 0.3,
          fill: false
        }]
      }
    });
  </script>
@endpush