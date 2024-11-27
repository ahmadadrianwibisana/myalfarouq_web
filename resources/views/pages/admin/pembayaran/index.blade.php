@extends('layouts.admin.main') 
@section('title', 'Admin Pembayaran') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Pembayaran</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Pembayaran</div> 
            </div> 
        </div> 

        <!-- Tombol Tambah Pembayaran -->
        <a href="#" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Pembayaran
        </a>  

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>ID Pemesanan</th> 
                                <th>Bukti Pembayaran</th> 
                                <th>Tanggal Pembayaran</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($pembayarans as $item) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $item->pemesanan_id }}</td> 
                                    <td>
                                        <a href="{{ asset('storage/' . $item->bukti_pembayaran) }}" target="_blank">
                                            <img src="{{ asset('storage/' . $item->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="50" class="img-thumbnail">
                                        </a>
                                    </td>
                                    <td>{{ date('d M Y, H:i', strtotime($item->tanggal_pembayaran)) }}</td>
                                    <td> 
                                        <a href="#" class="badge badge-info">Detail</a> 
                                        <a href="#" class="badge badge-warning">Edit</a> 
                                        <a href="#" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="5" class="text-center">Data Pembayaran Kosong</td> 
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
