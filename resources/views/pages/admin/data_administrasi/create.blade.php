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
            <form action="{{ route('admin.data_administrasi.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pemesanan_id">Pemesanan</label>
                                <select name="pemesanan_id" id="pemesanan_id" class="form-control @error('pemesanan_id') is-invalid @enderror" required>
                                    <option value="">Pilih Pemesanan</option>
                                    @foreach ($pemesanan as $item)
                                        <option value="{{ $item->id }}" {{ old('pemesanan_id') == $item->id ? 'selected' : '' }}>
                                            {{ $item->trip_type == 'open_trip' ? $item->openTrip->nama_paket : $item->privateTrip->nama_trip }} 
                                            (ID: {{ $item->id }}, User: {{ $item->user->name }})
                                        </option>
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
                                <input id="file_dokumen" type="file" class="form-control @error('file_dokumen') is-invalid @enderror" name="file_dokumen" required>
                                @error('file_dokumen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">
                                Silakan unggah dokumen yang valid. Contoh dokumen: 
                                <strong><a href="{{ asset('uploads/contoh_dokumen.pdf') }}" target="_blank">contoh_dokumen.pdf</a></strong>, 
                                <strong><a href="{{ asset('uploads/gambar_dokumen.jpg') }}" target="_blank">gambar_dokumen.jpg</a></strong>. 
                                Format yang diterima: <strong>PDF, JPG, PNG</strong> (maksimal 10MB).
                            </small>
                            </div>

                            <div class="form-group">
                                <label for="status">Status Dokumen</label>
                                <select id="status" class="form-control" name="status" required>
                                    <option value="pending" selected>Pending</option>
                                    <!-- Hapus opsi lain -->
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
        // JavaScript untuk validasi form
        (function() {
            'use strict';

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation');

            // Loop over them and prevent submission
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
        document.getElementById('file_dokumen').addEventListener('change',function() {
            const fileInput = this;
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.pdf)$/i;
            if (!allowedExtensions.exec(filePath)) {
                alert('Silakan unggah file yang valid (PDF, JPG, PNG).');
                fileInput.value = ''; // Clear the input
            }
        });
    </script>
@endpush

@endsection