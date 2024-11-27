@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Dashboard') 

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
                <!-- Total Admin Besar -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #3F51B5;"> 
                            <i class="fas fa-user-shield"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Admin Besar</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $admin_besars }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Admin -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #3F51B5;"> 
                            <i class="fas fa-user-shield"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Admin Kecil</h4> 
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

                <!-- Total Riwayat -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #FFC107;"> 
                            <i class="fas fa-history"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Riwayat</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $riwayats }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Laporan -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #FF5722;">
                            <i class="fas fa-file-alt"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Laporan</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $laporans }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 

                <!-- Total Artikel -->
                <div class="col-lg-3 col-md-6 col-sm-6 col-12"> 
                    <div class="card card-statistic-1"> 
                        <div class="card-icon" style="background-color: #2196F3;">
                            <i class="fas fa-newspaper"></i> 
                        </div> 
                        <div class="card-wrap"> 
                            <div class="card-header"> 
                                <h4>Total Artikel</h4> 
                            </div> 
                            <div class="card-body"> 
                                {{ $artikels }} 
                            </div> 
                        </div> 
                    </div> 
                </div> 
            </div>

        </section> 
    </div> 
@endsection
