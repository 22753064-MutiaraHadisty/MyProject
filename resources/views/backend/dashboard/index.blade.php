@extends('backend.app')
@section('content')
        <div class="container-fluid mt-4">
            <div class="page-inner">
                <!-- Welcome Section -->
                <div class="jumbotron text-center text-white bg-dark p-5 rounded shadow-lg">
                    <h2 class="fw-bold">Selamat Datang di Dashboard Mutiara!</h2>
                    <p class="lead">"Dashboard ini dirancang untuk mempermudah pekerjaan Anda.<br>
                        Lihat data penting, pantau perkembangan, dan kelola informasi
                        dengan lebih praktis."</p>
                </div>

                <!-- Card Section -->
                <h3 class="fw-bold mb-3 mt-4">Statistik</h3>
                <div class="row g-3">
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-primary card-round shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon-big text-center text-white">
                                            <i class="fas fa-users fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Visitors</p>
                                            <h4 class="card-title">1,294</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-info card-round shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon-big text-center text-white">
                                            <i class="fas fa-user-check fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Subscribers</p>
                                            <h4 class="card-title">1,303</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-success card-round shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon-big text-center text-white">
                                            <i class="fas fa-chart-pie fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Sales</p>
                                            <h4 class="card-title">$ 1,345</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-seco                                                                                                                                                                                ndary card-round shadow-sm">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="icon-big text-center text-white">
                                            <i class="far fa-check-circle fa-2x"></i>
                                        </div>
                                    </div>
                                    <div class="col-8 col-stats">
                                        <div class="numbers">
                                            <p class="card-category">Order</p>
                                            <h4 class="card-title">576</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Section -->
            <!-- Grafik Section -->
            <h3 class="fw-bold mb-3 mt-4">Grafik</h3>
            <div class="row ml-3"> <!-- Tambahkan margin kiri -->
                <div class="col-md-5 d-flex justify-content-center">
                    <canvas id="pieChart" style="max-width: 400px; max-height: 400px;"></canvas>
                </div>
                <div class="col-md-6">
                    <canvas id="barChart" style="max-width: 600px; max-height: 400px;"></canvas>
                    <p class="text-muted mt-2" style="font-size: 14px; text-align: left;">
                        <strong>Keterangan Nilai:</strong><br>
                        A: 80 - 100<br>
                        B: 70 - 79<br>
                        C: 60 - 69<br>
                        D: 50 - 59<br>
                        E: < 50 </p>
                </div>
            </div>
            </div>
            </div>
        @php
$students = DB::table('students')->count();
$teachers = DB::table('teacher')->count();
$subjects = DB::table('mapel')->count();

$grades = [
    'A' => DB::table('nilai')->whereBetween('nilai', [80, 100])->count(),
    'B' => DB::table('nilai')->whereBetween('nilai', [70, 79])->count(),
    'C' => DB::table('nilai')->whereBetween('nilai', [60, 69])->count(),
    'D' => DB::table('nilai')->whereBetween('nilai', [50, 59])->count(),
    'E' => DB::table('nilai')->where('nilai', '<', 50)->count(),
];
        @endphp
@endsection

@section('script')
    <<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart
        var ctxPie = document.getElementById('pieChart').getContext('2d');
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: ['Students', 'Teachers', 'Mata Pelajaran'],
                datasets: [{
                    data: [{{ $students }}, {{ $teachers }}, {{ $subjects }}],
                    backgroundColor: ['#007bff', '#0056b3', '#003f7f'] // Biru terang yang lebih kuat
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Bar Chart
        var ctxBar = document.getElementById('barChart').getContext('2d');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: ['A', 'B', 'C', 'D', 'E'],
                datasets: [{
                    label: 'Jumlah Nilai',
                    data: [{{ $grades['A'] }}, {{ $grades['B'] }}, {{ $grades['C'] }}, {{ $grades['D'] }}, {{ $grades['E'] }}],
                    backgroundColor: ['#007bff', '#0056b3', '#00408a', '#002d66', '#001b40'] // Variasi biru terang dengan lebih kontras
                }]
            }
        });
    </script>
    </div>
@endsection