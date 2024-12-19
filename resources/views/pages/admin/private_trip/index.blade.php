@extends('layouts.admin.main') 
@section('title', 'Admin Private Trip') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Private Trip</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Private Trip</div> 
            </div> 
        </div> 

         <!-- Tombol Tambah Private Trip -->
         <a href="{{ route('admin.private_trip.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Private Trip
        </a>  

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>Nama User</th> <!-- Ubah dari Nama Trip menjadi Nama User -->
                                <th>Destinasi</th> 
                                <th>Tanggal Pergi</th> 
                                <th>Tanggal Kembali</th> 
                                <th>Star Point</th> 
                                <th>Jumlah Peserta</th> 
                                <th>Harga</th> 
                                <th>Status</th>
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($private_trips as $item) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $item->user_name }}</td> <!-- Tampilkan nama pengguna -->
                                    <td>{{ $item->destinasi }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_pergi)) }}</td>
                                    <td>{{ date('d M Y', strtotime($item->tanggal_kembali)) }}</td>
                                    <td>{{ $item->star_point }}</td>
                                    <td>{{ $item->jumlah_peserta }}</td>
                                    <td>Rp{{ number_format($item->harga, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge badge-{{ $item->status == 'pending' ? 'warning' : ($item->status == 'disetujui' ? 'success' : 'danger') }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td> 
                                    <a href="{{ route('admin.private_trip.show', $item->id) }}" class="badge badge-info">Detail</a>                                        
                                    <a href="{{ route('admin.private_trip.edit', $item->id) }}" class="badge badge-warning">Edit</a> 
                                        <a href="{{ route('admin.private_trip.delete', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="10" class="text-center">Data Private Trip Kosong</td> 
                                </tr>
                            @endforelse 
                        </tbody>
                    </table>
                     <!-- Pagination -->
                     <div class="mt-3 d-flex justify-content-center">
                        <!-- Previous Page Link -->
                        @if ($private_trips->onFirstPage())
                            <span class="page-link disabled box">Sebelumnya</span>
                        @else
                            <a href="{{ $private_trips->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                        @endif

                        <!-- Pagination Links -->
                        <ul class="pagination">
                            @foreach ($private_trips->getUrlRange(1, $private_trips->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $private_trips->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Next Page Link -->
                        @if ($private_trips->hasMorePages())
                            <a href="{{ $private_trips->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
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