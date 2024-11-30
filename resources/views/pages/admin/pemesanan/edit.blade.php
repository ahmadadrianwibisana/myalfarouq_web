@extends('layouts.admin.main')

@section('title', 'Admin Edit Pemesanan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Pemesanan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.pemesanan.index') }}">Pemesanan</a></div>
                <div class="breadcrumb-item">Edit Pemesanan</div>
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <form action="{{ route('admin.pemesanan.update', $pemesanan->id) }}" method="POST" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="user_id">Nama Pemesan</label>
                        <select id="user_id" class="form-control" name="user_id" required>
                            <option value="">-- Pilih Pengguna --</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ $pemesanan->user_id == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->no_telepon }})
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>

                    <div class="form-group">
                        <label for="trip_type">Tipe Trip</label>
                        <select id="trip_type" class="form-control" name="trip_type" required>
                            <option value="open_trip" {{ $pemesanan->trip_type == 'open_trip' ? 'selected' : '' }}>Open Trip</option>
                            <option value="private_trip" {{ $pemesanan->trip_type == 'private_trip' ? 'selected' : '' }}>Private Trip</option>
                        </select>
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>

                    <div class="form-group">
                        <label for="trip_id">Trip</label>
                        <select id="trip_id" class="form-control" name="trip_id" required>
                            @if ($pemesanan->trip_type == 'open_trip')
                                @foreach($openTrips as $openTrip)
                                    <option value="{{ $openTrip->id }}" {{ $pemesanan->open_trip_id == $openTrip->id ? 'selected' : '' }}>
                                        {{ $openTrip->nama_paket }}
                                    </option>
                                @endforeach
                            @elseif ($pemesanan->trip_type == 'private_trip')
                                @foreach($privateTrips as $privateTrip)
                                    <option value="{{ $privateTrip->id }}" {{ $pemesanan->private_trip_id == $privateTrip->id ? 'selected' : '' }}>
                                        {{ $privateTrip->nama_trip }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                        <input id="tanggal_pemesanan" type="date" class="form-control" name="tanggal_pemesanan" required value="{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('Y-m-d') }}">
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>
                

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                            <option value="pending" {{ $pemesanan->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="terkonfirmasi" {{ $pemesanan->status == 'terkonfirmasi' ? 'selected' : '' }}>Terkonfirmasi</option>
                            <option value="dibatalkan" {{ $pemesanan->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group" id="alasan_batal_container" style="display: none;">
                        <label for="alasan_batal">Alasan Pembatalan</label>
                        <textarea id="alasan_batal" name="alasan_batal" class="form-control">{{ old('alasan_batal', $pemesanan->alasan_batal) }}</textarea>
                        <div class="invalid-feedback">Kolom ini harus diisi jika status dibatalkan!</div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const statusSelect = document.getElementById('status');
    const alasanBatalContainer = document.getElementById('alasan_batal_container');

    function toggleAlasanBatal() {
        if (statusSelect.value === 'dibatalkan') {
            alasanBatalContainer.style.display = 'block';
        } else {
            alasanBatalContainer.style.display = 'none';
        }
    }

    // Inisialisasi tampilan saat halaman dimuat
    toggleAlasanBatal();

    // Tambahkan event listener untuk perubahan status
    statusSelect.addEventListener('change', toggleAlasanBatal);
});
</script>
@endsection