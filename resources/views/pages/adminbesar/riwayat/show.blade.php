@extends('layouts.adminbesar.main')

@section('title', 'Detail Riwayat')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Riwayat</h1>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5>ID Pemesanan: {{ $riwayat->pemesanan->id }}</h5>
                <p><strong>Nama Pemesan:</strong> {{ $riwayat->pemesanan->user->name }}</p>
                <p><strong>Status Pemesanan:</strong> {{ $riwayat->pemesanan->status }}</p>

                <h5>ID Pembayaran: {{ $riwayat->pembayaran->id }}</h5>
                <p><strong>Tanggal Pembayaran:</strong> {{ $riwayat->pembayaran->tanggal_pembayaran }}</p>
                <p><strong>Jumlah Pembayaran:</strong> {{ $riwayat->pembayaran->jumlah_pembayaran }}</p>
                <p><strong>Status Pembayaran:</strong> {{ $riwayat->pembayaran->status_pembayaran }}</p>

                <h5>ID Data Administrasi: {{ $riwayat->data_administrasi->id }}</h5>
                <p><strong>Status Data Administrasi:</strong> {{ $riwayat->data_administrasi->status }}</p>

                <p><strong>Tanggal Riwayat:</strong> {{ $riwayat->created_at->format('d-m-Y H:i:s') }}</p>

                <a href="{{ route('admin.riwayat.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </section>
</div>
@endsection