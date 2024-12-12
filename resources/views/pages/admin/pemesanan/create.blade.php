@extends('layouts.admin.main')

@section('title', 'Admin Tambah Pemesanan')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pemesanan</h1>
        </div>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.pemesanan.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <!-- Nama User -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">Nama User</label>
                                <select name="user_id" id="user_id" class="form-control" required>
                                    <option value="">Pilih User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Jenis Trip -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="trip_type">Jenis Trip</label>
                                <select name="trip_type" id="trip_type" class="form-control" onchange="toggleTripType()" required>
                                    <option value="">Pilih Jenis Trip</option>
                                    <option value="open_trip" {{ old('trip_type') == 'open_trip' ? 'selected' : '' }}>Open Trip</option>
                                    <option value="private_trip" {{ old('trip_type') == 'private_trip' ? 'selected' : '' }}>Private Trip</option>
                                </select>
                                @error('trip_type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Open Trip -->
                        <div id="open_trip_field" class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label for="open_trip_id">Open Trip</label>
                                <select name="trip_id" id="open_trip_id" class="form-control">
                                    <option value="">Pilih Open Trip</option>
                                    @foreach ($openTrips as $item)
                                        <option value="{{ $item->id }}" {{ old('trip_id') == $item->id ? 'selected' : '' }}>{{ $item->nama_paket }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                       
                        <!-- Private Trip -->
                        <div id="private_trip_field" class="col-md-6" style="display: none;">
                            <div class="form-group">
                                <label for="private_trip_id">Private Trip</label>
                                <select name="trip_id" id="private_trip_id" class="form-control" onchange="setPrivateTripUser (this)">
                                    <option value="">Pilih Private Trip</option>
                                    @foreach ($privateTrips as $item)
                                        <option value="{{ $item->id }}" data-user-id="{{ $item->user_id }}" {{ old('trip_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_trip }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Tanggal Pemesanan -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tanggal_pemesanan">Tanggal Pemesanan</label>
                                <input type="date" name="tanggal_pemesanan" id="tanggal_pemesanan" class="form-control" value="{{ old('tanggal_pemesanan') }}" required>
                                @error('tanggal_pemesanan')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                      <!-- Jumlah Peserta -->
                            <div id="jumlah_peserta_field" class="col-md-6" style="display: none;">
                                <div class="form-group">
                                    <label for="jumlah_peserta">Jumlah Peserta</label>
                                    <!-- <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" min="1" value="{{ old('jumlah_peserta') }}"> -->
                                    <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" value="1" min="1" required>
                                    @error('jumlah_peserta')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Pemesanan
                </button>
            </form>
        </div>
    </section>
</div> 

<script>
function toggleTripType() {
    const tripType = document.getElementById('trip_type').value;
    const openTripField = document.getElementById('open_trip_field');
    const privateTripField = document.getElementById('private_trip_field');
    const jumlahPesertaField = document.getElementById('jumlah_peserta_field');
    const userSelect = document.getElementById('user_id');

    if (tripType === 'open_trip') {
        openTripField.style.display = 'block';
        privateTripField.style.display = 'none';
        jumlahPesertaField.style.display = 'block'; // Tampilkan input jumlah peserta
        document.getElementById('private_trip_id').disabled = true;
        document.getElementById('open_trip_id').disabled = false;
        userSelect.disabled = false; // Aktifkan input manual untuk Open Trip
        userSelect.value = ''; // Reset pilihan user jika ada
    } else if (tripType === 'private_trip') {
        privateTripField.style.display = 'block';
        openTripField.style.display = 'none';
        jumlahPesertaField.style.display = 'none'; // Sembunyikan input jumlah peserta
        document.getElementById('open_trip_id').disabled = true;
        document.getElementById('private_trip_id').disabled = false;
        userSelect.disabled = true; // Nonaktifkan input manual untuk Private Trip
    } else {
        openTripField.style.display = 'none';
        privateTripField.style.display = 'none';
        jumlahPesertaField.style.display = 'none'; // Sembunyikan input jumlah peserta
        userSelect.disabled = false; // Aktifkan input manual jika tidak ada trip yang dipilih
        userSelect.value = ''; // Reset pilihan user jika ada
    }
}

function setPrivateTripUser (selectElement) {
    const selectedOption = selectElement.options[selectElement.selectedIndex];
    const userId = selectedOption.getAttribute('data-user-id');
    const userSelect = document.getElementById('user_id');

    if (userId) {
        userSelect.value = userId; // Isi otomatis `user_id` berdasarkan Private Trip
        userSelect.disabled = true; // Nonaktifkan input manual untuk `user_id`
    } else {
        alert('Private Trip ini tidak memiliki pengguna terkait.');
        selectElement.value = ''; // Reset pilihan Private Trip
        userSelect.value = ''; // Reset `user_id`
        userSelect.disabled = false; // Aktifkan kembali input manual
    }
}


</script>
@endsection