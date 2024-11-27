@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Laporan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Laporan List</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Laporan List</div> 
            </div> 
        </div> 

        <!-- Tombol Tambah Laporan -->
        <a href="#" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Laporan
        </a>    

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>Periode</th> 
                                <th>Total Pendapatan</th> 
                                <th>Periode Start</th> 
                                <th>Periode End</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($laporans as $laporan) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ ucfirst($laporan->periode) }}</td> 
                                    <td>{{ number_format($laporan->total_pendapatan, 2, ',', '.') }}</td>
                                    <td>{{ date('d M Y', strtotime($laporan->periode_start)) }}</td>
                                    <td>{{ date('d M Y', strtotime($laporan->periode_end)) }}</td>
                                    <td> 
                                        <a href="#" class="badge badge-info">Detail</a>     
                                        <a href="#" class="badge badge-warning">Edit</a> 
                                        <a href="#" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="6" class="text-center">Data Laporan Kosong</td> 
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
