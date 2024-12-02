@extends('layouts.adminbesar.main') 
@section('title', 'Detail Pemesanan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1 class="font-weight-bold text-dark">Detail Pemesanan</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}" class="text-dark">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">
                    <a href="{{ route('adminbesar.laporan.index') }}" class="text-dark">Daftar Pemesanan</a>
                </div>
                <div class="breadcrumb-item">Detail Pemesanan</div> 
            </div> 
        </div> 

        <div class="card shadow-lg mt-4">
            <div class="card-body"> 
                <h4 class="card-title font-weight-bold mb-3">Informasi Pemesanan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>User:</strong> <span class="text-muted">{{ $pemesanan->user->name ?? 'N/A' }}</span></p>
                        <p><strong>Trip Type:</strong> <span class="text-success">{{ ucfirst($pemesanan->trip_type) }}</span></p>
                        <p><strong>Status:</strong> <span class="text-success">{{ ucfirst($pemesanan->status) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Pemesanan:</strong> <span class="text-muted">{{ date('d M Y', strtotime($pemesanan->tanggal_pemesanan)) }}</span></p>
                        <p><strong>Total Pembayaran:</strong> <span class="text-danger">{{ number_format($pemesanan->total_pembayaran, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <h4 class="card-title font-weight-bold mt-4 mb-3">Data Administrasi</h4>
                <ul class="list-group">
                    @foreach ($pemesanan->dataAdministrasi as $data)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <p class="mb-0"><strong>Data Administrasi:</strong>
                                @if(isset($data->file_dokumen))
                                    <a href="{{ asset('storage/' . $data->file_dokumen) }}" target="_blank" class="btn btn-link text-success">
                                        Lihat Dokumen <i class="fas fa-file-download"></i>
                                    </a>
                                    <p class="mb-1"><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($data->status) ?? 'N/A' }}</span></p>
                                @else
                                    <span class="badge bg-warning">N/A</span>
                                @endif
                            </p>
                        </li>
                    @endforeach
                </ul>

                <h4 class="card-title font-weight-bold mt-4 mb-3">Detail Pembayaran</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Status Pembayaran:</strong> <span class="text-success">{{ ucfirst($pemesanan->pembayaran->status_pembayaran ?? 'Belum Dibayar') }}</span></p>
                        <p><strong>Tanggal Pembayaran:</strong> <span class="text-muted">{{ $pemesanan->pembayaran->tanggal_pembayaran ?? 'N/A' }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jumlah Pembayaran:</strong> <span class="text-danger">{{ number_format($pemesanan->pembayaran->jumlah_pembayaran ?? 0, 2, ',', '.') }}</span></p>
                        <p><strong>Bukti Pembayaran:</strong>
                            @if($pemesanan->pembayaran && $pemesanan->pembayaran->bukti_pembayaran)
                                <a href="{{ asset($pemesanan->pembayaran->bukti_pembayaran) }}" target="_blank" class="btn btn-link text-success">
                                    Lihat Bukti <i class="fas fa-file-image"></i>
                                </a>
                            @else
                                <span class="badge bg-warning">N/A</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="{{ route('adminbesar.laporan.index') }}" class="btn btn-lg" style="background-color: #276f5f; color: white;">
                        Kembali ke Daftar Pemesanan
                    </a>
                </div>
            </div> 
        </div>
    </section> 
</div> 
@endsection
