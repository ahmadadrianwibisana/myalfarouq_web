@extends('layouts.admin.main')

@section('title', 'Admin Detail Data Administrasi')

@section('content')

<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Detail Data Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.data_administrasi.index') }}">Data Administrasi</a>
                </div>
                <div class="breadcrumb-item">Detail Data Administrasi</div>
            </div>
        </div> 



        

        <!-- Back Button -->
        <a href="{{ route('admin.data_administrasi.index') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- Data Administrasi Detail -->
        <div class="row mt-4">
            <div class="col-12 col-md-10 col-lg-8 m-auto">
                <!-- Informasi Data Administrasi -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h4 class="text-dark">Informasi Data Administrasi</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong>Nama Pengguna:</strong> 
                                <span class="text-secondary">{{ $dataAdministrasi->pemesanan->user->name ?? 'User  tidak ditemukan' }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Email Pengguna:</strong> 
                                <span class="text-secondary">{{ $dataAdministrasi->pemesanan->user->email ?? 'Email tidak ditemukan' }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Jenis Trip:</strong> 
                                <span class="text-secondary">{{ ucfirst(str_replace('_', ' ', $dataAdministrasi->pemesanan->trip_type)) }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Tanggal Pemesanan:</strong> 
                                <span class="text-secondary">{{ \Carbon\Carbon::parse($dataAdministrasi->pemesanan->tanggal_pemesanan)->format('d-m-Y') }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Nama Trip:</strong>
                                <span class="text-secondary">
                                    @if ($dataAdministrasi->pemesanan->trip_type == 'open_trip')
                                        {{ $dataAdministrasi->pemesanan->openTrip->nama_paket ?? 'Nama Trip tidak ditemukan' }}
                                    @elseif ($dataAdministrasi->pemesanan->trip_type == 'private_trip')
                                        {{ $dataAdministrasi->pemesanan->privateTrip->nama_trip ?? 'Nama Trip tidak ditemukan' }}
                                    @endif
                                </span>
                            </li>
                            <li class="mb-3">
                                <strong>File Dokumen:</strong> 
                                <a href="{{ asset('storage/' . $dataAdministrasi->file_dokumen) }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-file-download"></i> Lihat Dokumen
                                </a>
                            </li>
                            <li class="mb-3">
                                <strong>Status:</strong>
                                <span class="badge 
                                    @if($dataAdministrasi->status == 'pending') badge-warning
                                    @elseif($dataAdministrasi->status == 'approved') badge-success
                                    @elseif($dataAdministrasi->status == 'rejected') badge-danger
                                    @endif">
                                    {{ ucfirst($dataAdministrasi->status) }}
                                </span>
                            </li>
                        </ul>
                        <!-- Pesan berdasarkan status -->
                        <div class="alert 
                            @if($dataAdministrasi->status == 'rejected') alert-danger
                            @elseif($dataAdministrasi->status == 'approved') alert-success
                            @else alert-warning
                            @endif mt-3">
                            @if($dataAdministrasi->status == 'rejected')
                                Dokumen ini ditolak. Silakan periksa dokumen yang diunggah.
                            @elseif($dataAdministrasi->status == 'approved')
                            Selamat! Dokumen Anda telah disetujui.
                            @else
                                Dokumen Anda masih dalam status pending.
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Informasi Pemesanan -->
                <div class="card mt-4 shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h4 class="text-dark">Informasi Pemesanan</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong>ID Pemesanan:</strong> 
                                <span class="text-secondary">{{ $dataAdministrasi->pemesanan->id }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Tanggal Berangkat:</strong> 
                                <span class="text-secondary">{{ \Carbon\Carbon::parse($dataAdministrasi->pemesanan->tanggal_berangkat)->format('d-m-Y') }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Tanggal Pulang:</strong> 
                                <span class="text-secondary">{{ \Carbon\Carbon::parse($dataAdministrasi->pemesanan->tanggal_pulang)->format('d-m-Y') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection