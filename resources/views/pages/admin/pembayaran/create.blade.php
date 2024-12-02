@extends('layouts.admin.main')

@section('title', 'Admin Tambah Pembayaran')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pembayaran</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.pembayaran.index') }}">Pembayaran</a></div>
                <div class="breadcrumb-item">Tambah Pembayaran</div>
            </div>
        </div>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="pemesanan_id">Pemesanan</label>
                            <select name="pemesanan_id" id="pemesanan_id" class="form-control @error('pemesanan_id') is-invalid @enderror" required onchange="updateTotalPembayaran()">
                                <option value="">Pilih Pemesanan</option>
                                @foreach ($pemesanans as $item)
                                    <option value="{{ $item->id }}" data-total-pembayaran="{{ $item->total_pembayaran }}" {{ old('pemesanan_id') == $item->id ? 'selected' : '' }}>
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
                            <label for="total_pembayaran">Total Pembayaran</label>
                            <input id="total_pembayaran" type="text" class="form-control" name="total_pembayaran" value="{{ old('total_pembayaran') }}" readonly>
                        </div>

                        <script>
                            function updateTotalPembayaran() {
                                var select = document.getElementById('pemesanan_id');
                                var selectedOption = select.options[select.selectedIndex];
                                var totalPembayaran = selectedOption.getAttribute('data-total-pembayaran');

                                // Set the total payment input value
                                document.getElementById('total_pembayaran').value = totalPembayaran;
                            }
                        </script>

                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran</label>
                                <input id="tanggal_pembayaran" type="date" class="form-control @error('tanggal_pembayaran') is-invalid @enderror" name="tanggal_pembayaran" value="{{ old('tanggal_pembayaran') }}" required>
                                @error('tanggal_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="jumlah_pembayaran">Jumlah Pembayaran</label>
                                <input id="jumlah_pembayaran" type="text" class="form-control @error('jumlah_pembayaran') is-invalid @enderror" name="jumlah_pembayaran" value="{{ old('jumlah_pembayaran') }}" required>
                                @error('jumlah_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bukti_pembayaran">Bukti Pembayaran</label>
                                <input id="bukti_pembayaran" type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran" required>
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
                        <i class="fas fa-plus"></i> Tambah Pembayaran
                    </button>
                </div>
            </form>
            @push('scripts')
    <script>
        // JavaScript untuk validasi form
        (function() {
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();

        // Optional: Menambahkan interaksi lainnya jika diperlukan
        document.getElementById('bukti_pembayaran').addEventListener('change', function() {
            const fileInput = this;
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Silakan unggah file yang valid (PDF, JPG, PNG).');
                fileInput.value = ''; // Clear the input
            }
        });

        // AJAX call to get total payment based on selected pemesanan_id
        document.getElementById('pemesanan_id').addEventListener('change', function() {
            const pemesananId = this.value;
            const totalPembayaranInput = document.getElementById('total_pembayaran');

            if (pemesananId) {
                fetch(`/admin/pembayaran/total/${pemesananId}`)
                    .then(response => response.json())
                    .then(data => {
                        totalPembayaranInput.value = data.total; // Set the total payment amount
                    })
                    .catch(error => {
                        console.error('Error fetching total payment:', error);
                        totalPembayaranInput.value = ''; // Clear the field in case of error
                    });
            } else {
                totalPembayaranInput.value = ''; // Clear the field if no pemesanan is selected
            }
        });
    </script>
@endpush

@endsection