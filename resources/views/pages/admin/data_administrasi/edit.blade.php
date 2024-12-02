@extends('layouts.admin.main')
@section('title', 'Admin Edit Data Administrasi')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Data Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.data_administrasi.index') }}">Data Administrasi</a></div>
                <div class="breadcrumb-item">Edit Data Administrasi</div>
            </div>
        </div>
        <a href="{{ route('admin.data_administrasi.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.data_administrasi.update', $dataAdministrasi->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pemesanan_id">Pemesanan</label>
                                <select id="pemesanan_id" class="form-control" name="pemesanan_id" required>
                                    <option value="">Pilih Pemesanan</option>
                                    @foreach($pemesanan as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $dataAdministrasi->pemesanan_id ? 'selected' : '' }}>
                                            {{ $item->id }} - {{ $item->user->name }} ({{ $item->status }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file_dokumen">File Dokumen</label>
                                <input id="file_dokumen" type="file" class="form-control" name="file_dokumen" accept="application/pdf,image/*">
                                @if($dataAdministrasi->file_dokumen)
                                    <a href="{{ asset('storage/' . $dataAdministrasi->file_dokumen) }}" target="_blank">Lihat Dokumen</a>
                                @endif
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="pending" {{ $dataAdministrasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $dataAdministrasi->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $dataAdministrasi->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
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