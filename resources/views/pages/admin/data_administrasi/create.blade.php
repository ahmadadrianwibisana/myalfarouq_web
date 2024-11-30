@extends('layouts.admin.main')

@section('title', 'Admin Tambah Data Administrasi')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Data Administrasi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.data_administrasi.index') }}">Data Administrasi</a></div>
                <div class="breadcrumb-item">Tambah Data Administrasi</div>
            </div>
        </div>
        <a href="{{ route('admin.data_administrasi.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.data_administrasi.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trip_type">Jenis Trip</label>
                                <select id="trip_type" class="form-control" name="trip_type" required>
                                    <option value="open_trip">Open Trip</option>
                                    <option value="private_trip">Private Trip</option>
                                </select>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="user_id">User</label>
                                <select id="user_id" class="form-control" name="user_id" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="open_trip_group">
                                <label for="open_trip_id">Open Trip</label>
                                <select id="open_trip_id" class="form-control" name="open_trip_id">
                                    @foreach ($open_trips as $open_trip)
                                        <option value="{{ $open_trip->id }}" {{ old('open_trip_id') == $open_trip->id ? 'selected' : '' }}>{{ $open_trip->nama_paket }}</option>
                                    @endforeach
                                </select>
                                @error('open_trip_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="private_trip_group" style="display:none;">
                                <label for="private_trip_id">Private Trip</label>
                                <select id="private_trip_id" class="form-control" name="private_trip_id">
                                    @foreach ($private_trips as $private_trip)
                                        <option value="{{ $private_trip->id }}" {{ old('private_trip_id') == $private_trip->id ? 'selected' : '' }}>{{ $private_trip->nama_paket }}</option>
                                    @endforeach
                                </select>
                                @error('private_trip_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="pemesanan_id">Pemesanan</label>
                                <select id="pemesanan_id" class="form-control" name="pemesanan_id" required>
                                    @foreach ($pemesanan as $order)
                                        <option value="{{ $order->id }}" {{ old('pemesanan_id') == $order->id ? 'selected' : '' }}>{{ $order->kode_pemesanan }}</option>
                                    @endforeach
                                </select>
                                @error('pemesanan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="file_dokumen">File Dokumen</label>
                                <input id="file_dokumen" type="file" class="form-control" name="file_dokumen" required>
                                @error('file_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="status">Status Dokumen</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i> Tambah Data Administrasi
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

@push('scripts')
    <script>
        document.getElementById('trip_type').addEventListener('change', function() {
            let tripType = this.value;
            let openTripGroup = document.getElementById('open_trip_group');
            let privateTripGroup = document.getElementById('private_trip_group');

            if (tripType === 'open_trip') {
                openTripGroup.style.display = 'block';
                privateTripGroup.style.display = 'none';
            } else if (tripType === 'private_trip') {
                openTripGroup.style.display = 'none';
                privateTripGroup.style.display = 'block';
            }
        });
    </script>
@endpush

@endsection
