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
        <a href="{{ route('admin.pembayaran.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Pembayaran
        </a>

        <div class="card mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Trip</th>
                                <th>Bukti Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Jumlah Pembayaran</th>
                                <th>Status Pembayaran</th>
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
                                    <td>{{ $item->pemesanan->user->name }}</td>
                                    <td>{{ $item->pemesanan->trip_type == 'open_trip' ? $item->pemesanan->openTrip->nama_paket : $item->pemesanan->privateTrip->nama_trip }}</td>
                                    <td>
                                        @if (file_exists(public_path($item->bukti_pembayaran)))
                                            <a href="{{ asset($item->bukti_pembayaran) }}" target="_blank">
                                                <img src="{{ asset($item->bukti_pembayaran) }}" alt="Bukti Pembayaran" width="50" class="img-thumbnail">
                                            </a>
                                        @else
                                            <span class="text-danger">File tidak ditemukan</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y, H:i', strtotime($item->tanggal_pembayaran)) }}</td>
                                    <td>{{  $item->jumlah_pembayaran }}</td>
                                    <td>{{  $item->status_pembayaran }}</td> <!-- Menampilkan status -->
                                    <td>
                                        <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="badge badge-info">Detail</a>
                                        <a href="{{ route('admin.pembayaran.edit', $item->id) }}" class="badge badge-warning">Edit</a>
                                        <a href="{{ route('admin.pembayaran.destroy', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Data Pembayaran Kosong</td>
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