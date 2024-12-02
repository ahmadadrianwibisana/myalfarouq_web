@extends('layouts.admin.main')

@section('title', 'Detail Pembayaran')

@section('content')

<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Detail Pembayaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.pembayaran.index') }}">Pembayaran</a>
                </div>
                <div class="breadcrumb-item">Detail Pembayaran</div>
            </div>
        </div> 

        <!-- Back Button -->
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <!-- Payment Details -->
        <div class="row mt-4">
            <div class="col-12 col-md-10 col-lg-8 m-auto">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-light">
                        <h4 class="text-dark">Informasi Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <strong>ID Pembayaran:</strong> 
                                <span class="text-secondary">{{ $pembayaran->id }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>ID Pemesanan:</strong> 
                                <span class="text-secondary">{{ $pembayaran->pemesanan->id }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Nama Pengguna:</strong> 
                                <span class="text-secondary">{{ $pembayaran->pemesanan->user->name }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Total Pembayaran:</strong> 
                                <span class="text-secondary">{{ $pembayaran->pemesanan->total_pembayaran }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Nama Trip:</strong>
                                <span class="text-secondary">
                                    @if ($pembayaran->pemesanan->trip_type == 'open_trip')
                                        {{ $pembayaran->pemesanan->openTrip->nama_paket ?? 'Nama Trip tidak ditemukan' }}
                                    @elseif ($pembayaran->pemesanan->trip_type == 'private_trip')
                                        {{ $pembayaran->pemesanan->privateTrip->nama_trip ?? 'Nama Trip tidak ditemukan' }}
                                    @else
                                        'Jenis Trip tidak ditemukan'
                                    @endif
                                </span>
                            </li>
                            <li class="mb-3">
                                <strong>Tanggal Pembayaran:</strong> 
                                <span class="text-secondary">{{ \Carbon\Carbon::parse($pembayaran->tanggal_pembayaran)->format('d-m-Y') }}</span>
                            </li>
                            <li class="mb-3">
                                <strong>Jumlah Pembayaran:</strong> 
                                <span class="text-secondary">{{ $pembayaran->jumlah_pembayaran }}</span>
                            </li>
                            <li class="mb-3">
                            <strong>Status Pembayaran:</strong> 
                                <span class="text-secondary">
                                    @if ($pembayaran->status_pembayaran == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                        <p class="text-warning">Pembayaran belum dikonfirmasi. Silakan tunggu konfirmasi dari admin.</p>
                                    @elseif ($pembayaran->status_pembayaran == 'success')
                                        <span class="badge badge-success">Success</span>
                                        <p class="text-success">Pembayaran telah berhasil dilakukan.</p>
                                    @elseif ($pembayaran->status_pembayaran == 'failed')
                                        <span class="badge badge-danger">Failed</span>
                                        <p class="text-danger">Pembayaran gagal. Alasan: {{ $pembayaran->alasan_gagal }}</p>
                                    @else
                                        <span class="badge badge-secondary">Status tidak dikenali</span>
                                        <p class="text-secondary">Status pembayaran tidak dapat diidentifikasi.</p>
                                    @endif
                                </span>
                            </li>
                            <li class="mb-3">
                                <strong>Bukti Pembayaran:</strong> 
                                <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-info">
                                    <i class="fas fa-file-download"></i> Lihat Bukti Pembayaran
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</div>

@endsection