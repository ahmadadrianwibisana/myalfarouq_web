@extends('layouts.admin.main') 

@section('title', 'Admin Detail Pemesanan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <!-- Header Section -->
        <div class="section-header"> 
            <h1 class="page-title">Detail Pemesanan</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.pemesanan.index') }}">Pemesanan</a>
                </div> 
                <div class="breadcrumb-item">Detail Pemesanan</div> 
            </div> 
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> 
        
        <!-- Pemesanan Detail -->
        <div class="row mt-4"> 
            <div class="col-12 col-md-12 col-lg-8 m-auto"> 
                <article class="article article-style-c">
                    <div class="article-details">
                        <!-- User Name and Phone Number -->
                        <div class="article-category mb-3">
                            <a href="#" class="badge badge-info">{{ $pemesanan->user->name }}</a>
                            <span class="badge badge-secondary">{{ $pemesanan->user->no_telepon }}</span>
                        </div>
                        
                        <!-- Status section -->
                        <p><strong>Status:</strong> 
                            <span class="badge badge-{{ $pemesanan->status == 'pending' ? 'warning' : ($pemesanan->status == 'terkonfirmasi' ? 'success' : 'danger') }}">
                                {{ ucfirst($pemesanan->status) }}
                            </span>
                        </p>

                        <!-- Title and Pricing Information -->
                        <div class="article-title mt-4">
                            <h2 class="text-dark">Tipe Trip: {{ ucfirst($pemesanan->trip_type) }}</h2>
                        </div>
                        
                        <hr> 
                        
                        <!-- Trip Details -->
                        <div class="trip-details">
                            <p><strong>Nama Trip:</strong> 
                                @if ($pemesanan->trip_type == 'open_trip')
                                    {{ $tripDetails->nama_paket ?? 'N/A' }}
                                @elseif ($pemesanan->trip_type == 'private_trip')
                                    {{ $tripDetails->nama_trip ?? 'N/A' }}
                                @endif
                            </p>
                            <p><strong>Tanggal Pemesanan:</strong> {{ date('d M Y', strtotime($pemesanan->tanggal_pemesanan)) }}</p>
                            
                            <!-- Total Payment Display -->
                            <div class="border rounded p-3 mb-4" style="background-color: #e9f7fe; border: 1px solid #b3e0ff;">
                                <h4 class="text-primary text-center">Total Pembayaran:</h4>
                                <p class="mb-0 text-center" style="font-size: 1.5rem; font-weight: bold; color: #007bff;">
                                    Rp. {{ number_format($pemesanan->total_pembayaran, 2, ',', '.') }}
                                </p>
                            </div>
                            
                            <p><strong>Deskripsi:</strong> 
                                @if ($pemesanan->trip_type == 'open_trip')
                                    {{ $tripDetails->deskripsi_trip ?? 'Tidak ada deskripsi' }}
                                @elseif ($pemesanan->trip_type == 'private_trip')
                                    {{ $tripDetails->deskripsi_trip ?? 'Tidak ada deskripsi' }}
                                @endif
                            </p>
                        </div>
                        
                        <!-- Additional Information -->
                        <div>
                            @if ($pemesanan->trip_type == 'open_trip')
                                <p><strong>Destinasi:</strong> {{ $tripDetails->destinasi ?? 'N/A' }}</p>
                                <p><strong>Tanggal Berangkat:</strong> {{ \Carbon\Carbon::parse($tripDetails->tanggal_berangkat)->format('d M Y') }}</p>
                                <p><strong>Tanggal Pulang:</strong> {{ \Carbon\Carbon::parse($tripDetails->tanggal_pulang)->format('d M Y') }}</p>
                                <p><strong>Harga per Peserta:</strong> Rp. {{ number_format($tripDetails->harga, 2, ',', '.') }}</p>
                                <p><strong>Lama Keberangkatan:</strong> {{ $tripDetails->lama_keberangkatan ?? 'N/A' }}</p>
                                <p><strong>Kuota:</strong> {{ $tripDetails->kuota ?? 'N/A' }}</p>
                                <p><strong>Jumlah Peserta:</strong> {{ $tripDetails->jumlah_peserta ?? 'N/A' }}</p>
                            @elseif ($pemesanan->trip_type == 'private_trip')
                                <p><strong>Destinasi:</strong> {{ $tripDetails->destinasi ?? 'N/A' }}</p>
                                <p><strong>Tanggal Pergi:</strong> {{ \Carbon\Carbon::parse($tripDetails->tanggal_pergi)->format('d M Y') }}</p>
                                <p><strong>Tanggal Kembali:</strong> {{ \Carbon\Carbon::parse($tripDetails->tanggal_kembali)->format('d M Y') }}</p>
                                <p><strong>Star Point:</strong> {{ $tripDetails->star_point ?? 'N/A' }}</p>
                                <p><strong>Jumlah Peserta:</strong> {{ $tripDetails->jumlah_peserta ?? 'N/A' }}</p>
                                <p><strong>Harga:</strong> Rp. {{ number_format($tripDetails->harga, 2, ',', '.') }}</p>
                                <p><strong>Tanggal Pengajuan:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_pengajuan)->format('d M Y') }}</p>
                                <p><strong>Tanggal Disetujui:</strong> {{ \Carbon\Carbon::parse($pemesanan->tanggal_disetujui)->format('d M Y') }}</p>
                            @endif
                        </div>

                        <!-- Display messages based on status -->
                        @if($pemesanan->status == 'pending')
                            <div class="alert alert-warning mt-3" role="alert">
                                <strong>Pemesanan masih dalam proses!</strong> Pemesanan Anda belum disetujui.
                            </div>
                        @elseif($pemesanan->status == 'terkonfirmasi')
                            <div class="alert alert-success mt-3" role="alert">
                                <strong>Pemesanan telah disetujui!</strong> Tanggal disetujui: {{ \Carbon\Carbon::parse($pemesanan->tanggal_disetujui)->format('d M Y') }}.
                            </div>
                        @elseif($pemesanan->status == 'dibatalkan' && !empty($pemesanan->alasan_batal))
                            <p><strong>Keterangan Ditolak:</strong> {{ $pemesanan->alasan_batal }}</p>
                        @elseif($pemesanan->status == 'dibatalkan' && !empty($pemesanan->alasan_batal))
                            <div class="alert alert-danger mt-3" role="alert">
                                <strong>Pemesanan Dibatalkan!</strong> {{ $pemesanan->alasan_batal }}
                            </div>
                        @endif
                    </div> 
                </article> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection