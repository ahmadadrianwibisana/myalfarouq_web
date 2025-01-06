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
                        <input type="text" class="form-control" value="{{ $pemesanan->user->name }} ({{ $pemesanan->user->no_telepon }})" disabled>
                        <input type="hidden" name="user_id" value="{{ $pemesanan->user_id }}">
                    </div>
                    <div class="form-group">
                        <label for="trip_type">Tipe Trip</label>
                        <input type="text" id="trip_type" class="form-control" value="{{ $pemesanan->trip_type == 'open_trip' ? 'Open Trip' : 'Private Trip' }}" disabled>
                        <input type="hidden" name="trip_type" value="{{ $pemesanan->trip_type }}">
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
                                <option value="{{ $pemesanan->private_trip_id }}" selected>
                                    {{ $privateTrips->find($pemesanan->private_trip_id)->nama_trip ?? 'Trip Tidak Ditemukan' }}
                                </option>
                                
                            @endif
                            </select>
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>


                    
                    <div class="form-group">
                        <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                        <input id="tanggal_pemesanan" type="date" class="form-control" name="tanggal_pemesanan" required value="{{ \Carbon\Carbon::parse($pemesanan->tanggal_pemesanan)->format('Y-m-d') }}">
                        <div class="invalid-feedback">Kolom ini harus diisi!</div>
                    </div>

                    <div class="form-group" id="jumlah_peserta_field" style="display: {{ $pemesanan->trip_type === 'open_trip' ? 'block' : 'none' }};">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" value="{{ old('jumlah_peserta', $pemesanan->jumlah_peserta) }}" min="1" required>
                        @error('jumlah_peserta')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group" id="star_point_field" style="display: {{ $pemesanan->trip_type === 'open_trip' ? 'block' : 'none' }};">
                        <label for="star_point">Star Point</label>
                        <input type="text" name="star_point" id="star_point" class="form-control" value="{{ old('star_point', $pemesanan->star_point) }}" required>
                        @error('star_point')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tour_gate">Tour Gate</label>
                        <input type="text" id="tour_gate" name="tour_gate" class="form-control" value="{{ old('tour_gate', $pemesanan->tour_gate) }}" placeholder="Masukkan Tour Gate">
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

                    <div class="form-group" id="alasan_batal_container" style="display: {{ $pemesanan->status == 'dibatalkan' ? 'block' : 'none' }};">
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
    const tripTypeInput = document.querySelector('input[name="trip_type"]');
    const jumlahPesertaField = document.getElementById('jumlah_peserta_field');
    const starPointField = document.getElementById('star_point_field');
    const statusSelect = document.getElementById('status');
    const alasanBatalContainer = document.getElementById('alasan_batal_container');

    // Inisialisasi tampilan saat halaman dimuat
    toggleTripType();
    toggleAlasanBatal();

    function toggleTripType() {
        const tripType = tripTypeInput.value;

        if (tripType === 'open_trip') {
            jumlahPesertaField.style.display = 'block'; // Tampilkan input jumlah peserta
            starPointField.style.display = 'block'; // Tampilkan input star point
        } else {
            jumlahPesertaField.style.display = 'none'; // Sembunyikan input jumlah peserta
            starPointField.style.display = 'none'; // Sembunyikan input star point
        }
    }

    function toggleAlasanBatal() {
        if (statusSelect.value === 'dibatalkan') {
            alasanBatalContainer.style.display = 'block';
        } else {
            alasanBatalContainer.style.display = 'none';
        }
    }

    // Tambahkan event listener untuk perubahan status
    statusSelect.addEventListener('change', toggleAlasanBatal);
});
</script>
@endsection