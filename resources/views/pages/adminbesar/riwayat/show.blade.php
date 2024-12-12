@extends('layouts.adminbesar.main')

@section('title', 'Detail Pemesanan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 style="color: #276f5f;"><i class="fas fa-info-circle"></i> Detail Pemesanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;"><i class="fas fa-home"></i> Dashboard</a>
                </div>
                <div class="breadcrumb-item">
                    <a href="{{ route('adminbesar.riwayat.index') }}" style="color: #276f5f;"><i class="fas fa-clipboard-list"></i> Riwayat Pemesanan</a>
                </div>
                <div class="breadcrumb-item" style="color: #276f5f;">Detail Pemesanan</div>
            </div>
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body">
                <h4 class="font-weight-bold" style="color: #276f5f;">Informasi Pemesanan</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>User:</strong> <span class="text-muted">{{ $pemesanan->user->name ?? 'N/A' }}</span></p>
                        <p><strong>Trip Type:</strong> <span class="text-success">{{ ucfirst($pemesanan->trip_type) }}</span></p>
                        <p><strong>Nama Trip:</strong> 
                            @if ($pemesanan->trip_type == 'private_trip')
                                {{ $pemesanan->privateTrip->nama_trip ?? 'N/A' }}
                            @elseif ($pemesanan->trip_type == 'open_trip')
                                {{ $pemesanan->openTrip->nama_paket ?? 'N/A' }}
                            @else
                                N/A
                            @endif
                        </p>
                        <p><strong>Status:</strong> <span class="badge badge-{{ $pemesanan->status === 'approved' ? 'success' : ($pemesanan->status === 'pending' ? 'warning' : ($pemesanan->status === 'rejected' ? 'danger' : 'secondary')) }}">
                            {{ ucfirst($pemesanan->status) }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Tanggal Pemesanan:</strong> <span class="text-muted">{{ date('d M Y', strtotime($pemesanan->tanggal_pemesanan)) }}</span></p>
                        <p><strong>Total Pembayaran:</strong> <span class="text-danger">Rp {{ number_format($pemesanan->total_pembayaran, 2, ',', '.') }}</span></p>
                    </div>
                </div>

                <h4 class="font-weight-bold mt-4" style="color: #276f5f;">Data Administrasi</h4>
                <ul class="list-group">
                    @foreach ($pemesanan->dataAdministrasi as $data)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-0"><strong>Data Administrasi:</strong></p>
                                @if(isset($data->file_dokumen))
                                    <a href="{{ asset('storage/' . $data->file_dokumen) }}" target="_blank" class="btn btn-link text-success">
                                        Lihat Dokumen <i class="fas fa-file-download"></i>
                                    </a>
                                @else
                                    <span class="badge bg-warning">N/A</span>
                                @endif
                                <p class="mb-1"><strong>Status:</strong> <span class="badge bg-info">{{ ucfirst($data->status) ?? 'N/A' }}</span></p>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <h4 class="font-weight-bold mt-4" style="color: #276f5f;">Detail Pembayaran</h4>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Status Pembayaran:</strong> <span class="text-success">{{ ucfirst($pemesanan->pembayaran->status_pembayaran ?? 'Belum Dibayar') }}</span></p>
                        <p><strong>Tanggal Pembayaran:</strong> <span class="text-muted">{{ $pemesanan->pembayaran->tanggal_pembayaran ?? 'N/A' }}</span></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jumlah Pembayaran:</strong> <span class="text-danger">Rp {{ number_format($pemesanan->pembayaran->jumlah_pembayaran ?? 0, 2, ',', '.') }}</span></p>
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
                    <a href="{{ route('adminbesar.riwayat.index') }}" class="btn btn-lg" style="background-color: #276f5f; color: white;">
                        <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pemesanan
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
