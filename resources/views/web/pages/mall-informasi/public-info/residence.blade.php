@extends ('layouts.mall-informasi-layouts.dashboard')

@section('page_title', 'Informasi Kependudukan')

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
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12">
				<div class="card">
					<div class="card-header">
						<h2 class="card-title">Dashboard Informasi Kependudukan</h1>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="card shadow">
									<div class="card-body">
										<h3>Jumlah Penduduk Berdasarkan Jenis Kelamin</h3>
										<canvas id="genderChart"></canvas>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="card shadow">
									<div class="card-body">
										<h3>Distribusi Usia</h3>
										<canvas id="ageChart"></canvas>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-4 col-sm-12">
								<div class="card shadow">
									<div class="card-body">
										<h3>Pertumbuhan Penduduk per Tahun</h3>
										<canvas id="growthChart"></canvas>
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
	const genderCtx = document.getElementById('genderChart').getContext('2d');
	new Chart(genderCtx, {
		type: 'pie',
		data: {
			labels: ['Laki-laki', 'Perempuan'],
			datasets: [{
				data: [520, 480],
				backgroundColor: ['#36A2EB', '#FF6384']
			}]
		}
	});

	const ageCtx = document.getElementById('ageChart').getContext('2d');
	new Chart(ageCtx, {
		type: 'bar',
		data: {
			labels: ['0-14', '15-24', '25-44', '45-64', '65+'],
			datasets: [{
				label: 'Jumlah Penduduk',
				data: [150, 120, 300, 200, 80],
				backgroundColor: '#4CAF50'
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

	const growthCtx = document.getElementById('growthChart').getContext('2d');
	new Chart(growthCtx, {
		type: 'line',
		data: {
			labels: ['2020', '2021', '2022', '2021', '2023', '2024'],
			datasets: [{
				label: 'Jumlah Penduduk',
				data: [1000, 1050, 1100, 1150, 1200, 1250],
				borderColor: '#FF9800',
				fill: false,
				tension: 0.3
			}]
		}
	});
</script>
@endpush