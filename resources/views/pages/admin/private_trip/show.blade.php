@extends('layouts.admin.main') 

@section('title', 'Admin Detail Private Trip') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <!-- Header Section -->
        <div class="section-header"> 
            <h1 class="page-title">Detail Private Trip</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.private_trip.index') }}">Private Trip</a>
                </div> 
                <div class="breadcrumb-item">Detail Private Trip</div> 
            </div> 
        </div>
        
        <!-- Back Button -->
        <a href="{{ route('admin.private_trip.index') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> 
        
        <!-- Private Trip Detail -->
        <div class="row mt-4"> 
            <div class="col-12 col-md-12 col-lg-8 m-auto"> 
                <article class="article article-style-c">
                    <div class="article-header mb-4">
                        <!-- Updated image path -->
                        <div class="article-image" style="background-image: url('{{ asset('private_trip_images/' . $private_trip->image) }}');">  
                        </div> 
                    </div>  
                    <div class="article-details">
                        <!-- User Name and Destination -->
                        <div class="article-category mb-3">
                            <a href="#" class="badge badge-info">{{ $private_trip->user_name }}</a>
                            <div class="bullet"></div>
                            <a href="#" class="badge badge-primary">{{ $private_trip->destinasi }}</a>
                        </div>
                        
                        <!-- Status section -->
                        <p><strong>Status:</strong> 
                            <span class="badge badge-{{ $private_trip->status == 'pending' ? 'warning' : ($private_trip->status == 'disetujui' ? 'success' : 'danger') }}">
                                {{ ucfirst($private_trip->status) }}
                            </span>
                        </p>

                        <!-- Title and Pricing Information -->
                        <div class="article-title mt-4">
                            <h2 class="text-dark">Harga: Rp{{ number_format($private_trip->harga, 0, ',', '.') }} - {{ $private_trip->jumlah_peserta }} Peserta</h2>
                        </div>
                        
                        <hr> 
                        
                        <!-- Trip Details -->
                        <div class="trip-details">
                            <p><strong>Nomor Telepon:</strong> {{ $private_trip->no_telepon }}</p>
                            <p><strong>Nama Trip:</strong> {{ $private_trip->nama_trip }}</p>
                            <p><strong>Tanggal Pergi:</strong> {{ date('d M Y', strtotime($private_trip->tanggal_pergi)) }}</p>
                            <p><strong>Tanggal Kembali:</strong> {{ date('d M Y', strtotime($private_trip->tanggal_kembali)) }}</p>
                            <p><strong>Star Point:</strong> {{ $private_trip->star_point }}</p>
                            <p><strong>Deskripsi Trip:</strong> {{ $private_trip->deskripsi_trip }}</p>
                            
                            <!-- Add Tanggal Pengajuan and Tanggal Disetujui -->
                            <p><strong>Tanggal Pengajuan:</strong> {{ \Carbon\Carbon::parse($private_trip->tanggal_pengajuan)->format('d M Y') }}</p>
                            
                            <p><strong>Tanggal Disetujui:</strong> 
                                @if ($private_trip->tanggal_disetujui)
                                    {{ \Carbon\Carbon::parse($private_trip->tanggal_disetujui)->format('d M Y') }}
                                @else
                                    Belum Disetujui
                                @endif
                            </p>

                            <!-- Display the Keterangan Ditolak if the status is rejected -->
                            @if($private_trip->status == 'ditolak' && !empty($private_trip->keterangan_ditolak))
                                <p><strong>Keterangan Ditolak:</strong> {{ $private_trip->keterangan_ditolak }}</p>
                            @endif
                        </div>
                        
                        @if(isset($private_trip->description) && !empty($private_trip->description))
                            <p><strong>Deskripsi Lengkap:</strong> {{ $private_trip->description }}</p> <!-- If there is a description -->
                        @endif
                    </div> 
                </article> 
            </div> 
        </div> 
    </section> 
</div> 
@endsection
