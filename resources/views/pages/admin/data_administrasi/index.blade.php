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
                                <th>No</th>
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
                            @foreach ($data_administrasis as $pemesanan_id => $items)
                                @php $firstItem = $items->first(); @endphp
                                <tr>
                                    <td>{{ ++$no }}</td>
                                    <td>{{ $firstItem->pemesanan->user ? $firstItem->pemesanan->user->name : 'User  tidak ditemukan' }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $firstItem->pemesanan->trip_type)) }}</td>
                                    <td>
                                        @if ($firstItem->pemesanan)
                                            {{ \Carbon\Carbon::parse($firstItem->pemesanan->tanggal_pemesanan)->format('d-m-Y') ?? 'Tanggal tidak ditemukan' }}
                                        @else
                                            Tanggal tidak ditemukan
                                        @endif
                                    </td>
                                    <td>
                                        @if ($firstItem->pemesanan)
                                            @if ($firstItem->pemesanan->trip_type == 'open_trip')
                                                {{ $firstItem->pemesanan->openTrip->nama_paket ?? 'Nama Trip tidak ditemukan' }}
                                            @elseif ($firstItem->pemesanan->trip_type == 'private_trip')
                                                {{ $firstItem->pemesanan->privateTrip->nama_trip ?? 'Nama Trip tidak ditemukan' }}
                                            @endif
                                        @else
                                            Pemesanan tidak ditemukan
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            @foreach ($items as $item)
                                                <div class="mb-1 d-flex justify-content-between align-items-center" style="min-height: 50px;">
                                                    <div>
                                                        <a href="{{ asset('storage/'.$item->file_dokumen) }}" target="_blank" class="badge badge-primary">{{ basename($item->file_dokumen) }}</a>
                                                    </div>
                                                    <div class="d-flex" style="gap: 5px;"> <!-- Menggunakan gap untuk jarak antar badge -->
                                                        <a href="{{ route('admin.data_administrasi.show', $item->id) }}" class="badge badge-info">Detail</a>
                                                        <a href="{{ route('admin.data_administrasi.edit', $item->id) }}" class="badge badge-warning">Edit</a>
                                                        <a href="{{ route('admin.data_administrasi.destroy', $item->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge 
                                            @if($firstItem->status == 'pending') badge-warning
                                            @elseif($firstItem->status == 'approved') badge-success
                                            @elseif($firstItem->status == 'rejected') badge-danger
                                            @endif">
                                            {{ ucfirst($firstItem->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('admin.data_administrasi.editAll', $firstItem->pemesanan_id) }}" method="POST" style="margin-right: 10px; display: flex; align-items: center;">
                                                @csrf
                                                @method('PUT')
                                                <select name="status" required class="form-select" style="width: auto; margin-right: 5px;">
                                                    <option value="pending">Pending</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                                <button type="submit" class="badge badge-warning">Edit Semua</button>
                                            </form>
                                            <form action="{{ route('admin.data_administrasi.destroyAll', $firstItem->pemesanan_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="badge badge-danger" data-confirm-delete="true">Hapus Semua</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('form[data-confirm-delete="true"]');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Apakah Anda yakin ingin menghapus semua data ini?')) {
                    e.preventDefault(); // Prevent form submission if user cancels
                }
            });
        });
    });
</script>
<style>
    .table td {
    vertical-align: middle; /* Menjaga semua elemen dalam sel tabel sejajar secara vertikal */
}

.form-select {
    margin-right: 5px; /* Menambahkan sedikit jarak antara dropdown dan tombol */
}

.badge {
    margin-left: 5px; /* Menambahkan sedikit jarak antara badge */
}
</style>
@endsection