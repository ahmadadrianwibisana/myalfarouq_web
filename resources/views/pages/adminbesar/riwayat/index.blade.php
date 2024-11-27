@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Riwayat') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Riwayat List</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Riwayat List</div> 
            </div> 
        </div>     

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>User</th> 
                                <th>Pemesanan</th> 
                                <th>Trip Type</th> 
                                <th>Status Pembayaran</th> 
                                <th>Status Administrasi</th> 
                                <th>Jumlah Pembayaran</th> 
                                <th>Tanggal Pembayaran</th>
                                <th>Tanggal Riwayat</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($riwayats as $riwayat) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $riwayat->user->name }}</td> 
                                    <td>{{ $riwayat->pemesanan->kode_pemesanan }}</td> 
                                    <td>{{ ucfirst($riwayat->trip_type) }}</td> 
                                    <td>{{ ucfirst($riwayat->status_pembayaran) }}</td>
                                    <td>{{ ucfirst($riwayat->status_administrasi) }}</td>
                                    <td>{{ number_format($riwayat->jumlah_pembayaran, 2, ',', '.') }}</td>
                                    <td>{{ $riwayat->tanggal_pembayaran ? date('d M Y H:i', strtotime($riwayat->tanggal_pembayaran)) : 'Belum Dibayar' }}</td>
                                    <td>{{ date('d M Y H:i', strtotime($riwayat->tanggal_riwayat)) }}</td>
                                    <td> 
                                    <a href="#" class="badge badge-info">Detail</a>     
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="10" class="text-center">Data Riwayat Kosong</td> 
                                </tr>
                            @endforelse 
                        </tbody>
                    </table> 
                </div> 
            </div> 
        </div>
    </section> 
</div> 
@endsection
