@extends('layouts.admin.main')

@section('title', 'Admin Data Administrasi')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Data Administrasi</div>
            </div>
        </div>
        <a href="{{ route('admin.data_administrasi.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Administrasi
        </a>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pengguna</th>
                                <th>Jenis Trip</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Nama Trip</th>
                                <th>File Dokumen</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 0; @endphp
                            @forelse ($data_administrasis as $item)
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $item->pemesanan->user ? $item->pemesanan->user->name : 'User  tidak ditemukan' }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $item->pemesanan->trip_type)) }}</td>
                                    <td>
                                        @if ($item->pemesanan)
                                            {{ \Carbon\Carbon::parse($item->pemesanan->tanggal_pemesanan)->format('d-m-Y') ?? 'Tanggal tidak ditemukan' }}
                                        @else
                                            Tanggal tidak ditemukan
                                        @endif
                                    </td>
                                    <td>
                                        @if ($item->pemesanan)
                                            @if ($item->pemesanan->trip_type == 'open_trip')
                                                {{ $item->pemesanan->openTrip->nama_paket ?? 'Nama Trip tidak ditemukan' }}
                                            @elseif ($item->pemesanan->trip_type == 'private_trip')
                                                {{ $item->pemesanan->privateTrip->nama_trip ?? 'Nama Trip tidak ditemukan' }}
                                            @endif
                                        @else
                                            Pemesanan tidak ditemukan
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/'.$item->file_dokumen) }}" target="_blank" class="badge badge-primary">Lihat Dokumen                                        </a>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($item->status == 'pending') badge-warning
                                            @elseif($item->status == 'approved') badge-success
                                            @elseif($item->status == 'rejected') badge-danger
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.data_administrasi.show', $item->id) }}" class="badge badge-info">Detail</a>
                                        <a href="{{ route('admin.data_administrasi.edit', $item->id) }}" class="badge badge-warning">Edit</a>
                                        <a href="{{ route('admin.data_administrasi.destroy', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data Administrasi Kosong</td>
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