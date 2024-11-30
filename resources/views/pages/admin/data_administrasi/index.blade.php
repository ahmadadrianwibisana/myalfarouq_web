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
            <i class="fas fa-plus"></i> Tambah Open Trip
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
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $item->trip_type)) }}</td>
                                    <td>
                                        @if ($item->trip_type == 'open_trip' && $item->open_trip)
                                            {{ $item->open_trip->nama_trip }}
                                        @elseif ($item->trip_type == 'private_trip' && $item->private_trip)
                                            {{ $item->private_trip->nama_trip }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ asset('storage/'.$item->file_dokumen) }}" target="_blank" class="badge badge-primary">Lihat Dokumen</a>
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
                                        <a href="#" class="badge badge-info">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data Administrasi Kosong</td>
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
