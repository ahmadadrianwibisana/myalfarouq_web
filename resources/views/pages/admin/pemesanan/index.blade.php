@extends('layouts.admin.main') 
@section('title', 'Admin Pemesanan') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Pemesanan</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Pemesanan</div> 
            </div> 
        </div> 

        <!-- Tombol Tambah Pemesanan -->
        <a href="{{ route('admin.pemesanan.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Pemesanan
        </a>  

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>No</th> 
                                <th>User</th> 
                                <th>Tipe Trip</th> 
                                <th>Nama Trip</th> 
                                <th>Tanggal Pemesanan</th> 
                                <th>Status</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($pemesanans as $item) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $item->user->name ?? 'N/A' }}</td> <!-- Menampilkan nama pengguna -->
                                    <td>{{ ucfirst($item->trip_type) }}</td>
                                    <td>
                                        @if ($item->trip_type == 'open_trip')
                                            {{ $item->openTrip->nama_paket ?? 'N/A' }} <!-- Menampilkan nama paket open trip -->
                                        @elseif ($item->trip_type == 'private_trip')
                                            {{ $item->privateTrip->nama_trip ?? 'N/A' }} <!-- Menampilkan nama trip private -->
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y, H:i', strtotime($item->tanggal_pemesanan)) }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($item->status == 'pending') badge-warning 
                                            @elseif($item->status == 'terkonfirmasi') badge-success 
                                            @else badge-danger 
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td> 
                                        <a href="{{ route('admin.pemesanan.show', $item->id) }}" class="badge badge-info">Detail</a> 
                                        <a href="{{ route('admin.pemesanan.edit', $item->id) }}" class="badge badge-warning">Edit</a> 
                                        <a href="{{ route('admin.pemesanan.delete', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="7" class="text-center">Data Pemesanan Kosong</td> 
                                </tr>
                            @endforelse 
                        </tbody>
                    </table> 

                     <!-- Pagination -->
                     <div class="mt-3 d-flex justify-content-center">
                        <!-- Previous Page Link -->
                        @if ($pemesanans->onFirstPage())
                            <span class="page-link disabled box">Sebelumnya</span>
                        @else
                            <a href="{{ $pemesanans->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                        @endif

                        <!-- Pagination Links -->
                        <ul class="pagination">
                            @foreach ($pemesanans->getUrlRange(1, $pemesanans->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $pemesanans->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Next Page Link -->
                        @if ($pemesanans->hasMorePages())
                            <a href="{{ $pemesanans->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
                        @else
                            <span class="page-link disabled box">Selanjutnya</span>
                        @endif
                    </div>
                </div> 
            </div> 
        </div>
    </section> 
</div> 
@endsection
