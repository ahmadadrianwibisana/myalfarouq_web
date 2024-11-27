@extends('layouts.admin.main') 
@section('title', 'Admin Open Trip') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Open Trip</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Open Trip</div> 
            </div> 
        </div> 

        <!-- Tombol Tambah Open Trip -->
        <a href="#" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Open Trip
        </a>  

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>Nama Paket</th> 
                                <th>Destinasi</th> 
                                <th>Tanggal Berangkat</th> 
                                <th>Tanggal Pulang</th> 
                                <th>Lama Keberangkatan</th> 
                                <th>Harga</th> 
                                <th>Kuota</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($open_trips as $item) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $item->nama_paket }}</td> 
                                    <td>{{ $item->destinasi }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_berangkat)) }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_pulang)) }}</td>
                                    <td>{{ $item->lama_keberangkatan }}</td>
                                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>{{ $item->kuota }}</td>  
                                    <td> 
                                        <a href="#" class="badge badge-info">Detail</a> 
                                        <a href="#" class="badge badge-warning">Edit</a> 
                                        <a href="#" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="9" class="text-center">Data Open Trip Kosong</td> 
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
