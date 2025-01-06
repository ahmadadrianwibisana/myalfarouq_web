@extends('layouts.admin.main') 
@section('title', 'Admin Dashboard') 

@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header"> 
                <h1>Dashboard</h1> 
                <div class="section-header-breadcrumb"> 
                    <div class="breadcrumb-item active">
                        <a href="#">Dashboard</a>
                    </div> 
                </div> 
            </div> 
            <div class="row">
                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #3F51B5;"> 
                            <i class="fas fa-user-shield"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Admin</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $admins }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Pengguna -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #4CAF50;">
                            <i class="fas fa-users"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Pengguna</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $users }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Open Trip -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #FF9800;"> 
                            <i class="fas fa-map-signs"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Open Trip</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $open_trips }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Private Trip -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #E91E63;"> 
                            <i class="fas fa-plane"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Private Trip</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $private_trips }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Pemesanan -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #00BCD4;"> 
                            <i class="fas fa-receipt"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Pemesanan</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $pemesanans }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Pembayaran -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #9C27B0;"> 
                            <i class="fas fa-money-check-alt"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Pembayaran</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $pembayarans }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Data Administrasi -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #673AB7;"> 
                            <i class="fas fa-folder-open"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Data Administrasi</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $data_administrasis }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div>

            <!-- Grafik Pemesanan -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistik Pemesanan Bulanan</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="position: relative; height: 40vh; width:  80vw;">
                                <canvas id="pemesananChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const ctx = document.getElementById('pemesananChart').getContext('2d');
                const monthlyData = @json($monthlyData);
                
                const labels = Object.keys(monthlyData);
                const data = Object.values(monthlyData);

                const pemesananChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Jumlah Pemesanan',
                            data: data,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 2,
                            fill: true,
                            pointRadius: 5,
                            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Jumlah Pemesanan'
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Bulan'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true,
                                position: 'top',
                            },
                            tooltip: {
                                mode: 'index',
                            }
                        }
                    }
                });
            </script>

        </section> 
    </div> 
@endsection