@extends('layouts.admin.main')

@section('title', 'Admin Edit Pembayaran')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Pembayaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.pembayaran.index') }}">Pembayaran</a></div>
                <div class="breadcrumb-item">Edit Pembayaran</div>
            </div>
        </div>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-icon icon-left btn-warning mb-4">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.pembayaran.update', $pembayaran->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pemesanan_id">Pemesanan</label>
                                <select name="pemesanan_id" id="pemesanan_id" class="form-control @error('pemesanan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Pemesanan</option>
                                    @foreach ($pemesanans as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $pembayaran->pemesanan_id ? 'selected' : '' }}>
                                            {{ $item->trip_type == 'open_trip' ? $item->openTrip->nama_paket : $item->privateTrip->nama_trip }} 
                                            (ID: {{ $item->id }}, User: {{ $item->user->name }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('pemesanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input id="tanggal_pembayaran" type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran', $pembayaran->tanggal_pembayaran) }}" required>
                                @error('tanggal_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                                <input id="jumlah_pembayaran" type="text" class="form-control @error('jumlah_pembayaran') is-invalid @enderror" name="jumlah_pembayaran" value="{{ old('jumlah_pembayaran', $pembayaran->jumlah_pembayaran) }}" required>
                                @error('jumlah_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                <input id="bukti_pembayaran" type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran">
                                @if ($pembayaran->bukti_pembayaran)
                                    <a href="{{ asset($pembayaran->bukti_pembayaran) }}" target="_blank">Lihat Bukti Pembayaran</a>
                                @endif
                                @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                    Silakan unggah dokumen yang valid. Format yang diterima: <strong>PDF, JPG, PNG</strong> (maksimal 10MB).
                                </small>
                            </div>
                        </div>
                        </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection