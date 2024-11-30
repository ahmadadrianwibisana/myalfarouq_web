@extends('layouts.admin.main') 
@section('title', 'Admin Tambah Private Trip') 
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Private Trip</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.private_trip.index') }}">Private Trip</a></div>
                <div class="breadcrumb-item">Tambah Private Trip</div>
            </div>
        </div>
        <a href="{{ route('admin.private_trip.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.private_trip.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="user_id">Nama User</label> 
                            <select name="user_id" id="user_id" class="form-control" onchange="updatePhoneNumber()"> 
                                <option value="">Pilih User</option>
                                @foreach ($users as $item) 
                                    <option value="{{ $item->id }}" data-no-telepon="{{ $item->no_telepon }}"> 
                                        {{ $item->name }} 
                                    </option> 
                                @endforeach 
    </select> 
</div>

<div class="form-group">
    <label for="no_telepon">No Telepon</label>
    <input id="no_telepon" type="text" class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon" value="{{ old('no_telepon') }}" required readonly>
    @error('no_telepon')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<script>
    function updatePhoneNumber() {
        var select = document.getElementById('user_id');
        var selectedOption = select.options[select.selectedIndex];
        var phoneNumber = selectedOption.getAttribute('data-no-telepon');

        // Set the phone number input value
        document.getElementById('no_telepon').value = phoneNumber;
    }
</script>
                            <div class="form-group">
                                <label for="nama_trip">Nama Trip</label>
                                <input id="nama_trip" type="text" class="form-control @error('nama_trip') is-invalid @enderror" name="nama_trip" value="{{ old('nama_trip') }}" required>
                                @error('nama_trip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="destinasi">Destinasi</label>
                                <input id="destinasi" type="text" class="form-control @error('destinasi') is-invalid @enderror" name="destinasi" value="{{ old('destinasi') }}" required>
                                @error('destinasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pergi">Tanggal Pergi</label>
                                <input id="tanggal_pergi" type="date" class="form-control @error('tanggal_pergi') is-invalid @enderror" name="tanggal_pergi" value="{{ old('tanggal_pergi') }}" required>
                                @error('tanggal_pergi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input id="tanggal_kembali" type="date" class="form-control @error('tanggal_kembali') is-invalid @enderror" name="tanggal_kembali" value="{{ old('tanggal_kembali') }}" required>
                                @error('tanggal_kembali')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="star_point">Star Point</label>
                                <input id="star_point" type="text" class="form-control @error('star_point') is-invalid @enderror" name="star_point" value="{{ old('star_point') }}" required>
                                @error('star_point')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input id="jumlah_peserta" type="number" class="form-control @error('jumlah_peserta') is-invalid @enderror" name="jumlah_peserta" value="{{ old('jumlah_peserta') }}" required>
                                @error('jumlah_peserta')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" required step="0.01">
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input id="image" type="file" class="form-control" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Format gambar yang diizinkan: JPG, PNG.</small>
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value="">Pilih Status</option>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi_trip">Deskripsi Trip</label>
                                <textarea id="deskripsi_trip" class="form-control @error('deskripsi_trip') is-invalid @enderror" name="deskripsi_trip" rows="4" required>{{ old('deskripsi_trip') }}</textarea>
                                @error('deskripsi_trip')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i> Tambah Private Trip
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection
