@extends('layouts.admin.main')
@section('title', 'Admin Edit Private Trip')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Private Trip</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.private_trip.index') }}">Private Trip</a></div>
                <div class="breadcrumb-item">Edit Private Trip</div>
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

        <a href="{{ route('admin.private_trip.index') }}" class="btn btn-icon icon-left btn-warning mb-3">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card">
            <form action="{{ route('admin.private_trip.update', $privateTrip->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_id">Nama Pemesan</label>
                                <select id="user_id" class="form-control" name="user_id" required>
                                    <option value="">-- Pilih Pengguna --</option>
                                    @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $privateTrip->user_id == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->no_telepon }})
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="nama_trip">Nama Trip</label>
                                <input id="nama_trip" type="text" class="form-control" name="nama_trip" required value="{{ $privateTrip->nama_trip }}">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="destinasi">Destinasi</label>
                                <input id="destinasi" type="text" class="form-control" name="destinasi" required value="{{ $privateTrip->destinasi }}">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pergi">Tanggal Pergi</label>
                                <input id="tanggal_pergi" type="date" class="form-control" name="tanggal_pergi" required value="{{ $privateTrip->tanggal_pergi ? \Carbon\Carbon::parse($privateTrip->tanggal_pergi)->format('Y-m-d') : '' }}">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_kembali">Tanggal Kembali</label>
                                <input id="tanggal_kembali" type="date" class="form-control" name="tanggal_kembali" required value="{{ $privateTrip->tanggal_kembali ? \Carbon\Carbon::parse($privateTrip->tanggal_kembali)->format('Y-m-d') : '' }}">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="jumlah_peserta">Jumlah Peserta</label>
                                <input id="jumlah_peserta" type="number" class="form-control" name="jumlah_peserta" required value="{{ $privateTrip->jumlah_peserta }}">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input id="harga" type="number" class="form-control" name="harga" required value="{{ $privateTrip->harga }}" step="0.01">
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*">
                                @if($privateTrip->image)
                                    <img src="{{ asset('private_trip_images/' . $privateTrip->image) }}" alt="Trip Image" width="100" class="mt-2">
                                @endif
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="pending" {{ old('status', $privateTrip->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="disetujui" {{ old('status', $privateTrip->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ old('status', $privateTrip->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group" id="keterangan_ditolak_field" style="display: none;">
                                <label for="keterangan_ditolak">Keterangan Ditolak</label>
                                <textarea id="keterangan_ditolak" name="keterangan_ditolak" class="form-control @error('keterangan_ditolak') is-invalid @enderror">{{ old('keterangan_ditolak', $privateTrip->keterangan_ditolak) }}</textarea>
                                @error('keterangan_ditolak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const statusField = document.getElementById('status');
                                    const keteranganDitolakField = document.getElementById('keterangan_ditolak_field');

                                    // Fungsi untuk menampilkan atau menyembunyikan kolom keterangan ditolak
                                    const toggleKeteranganDitolak = () => {
                                        if (statusField.value === 'ditolak') {
                                            keteranganDitolakField.style.display = 'block';
                                        } else {
                                            keteranganDitolakField.style.display = 'none';
                                        }
                                    };

                                    // Jalankan fungsi setiap kali status berubah
                                    statusField.addEventListener('change', toggleKeteranganDitolak);

                                    // Inisialisasi awal
                                    toggleKeteranganDitolak();
                                });
                            </script>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi_trip">Deskripsi Trip</label>
                                <textarea id="deskripsi_trip" class="form-control" name="deskripsi_trip" rows="4" required>{{ $privateTrip->deskripsi_trip }}</textarea>
                                <div class="invalid-feedback">Kolom ini harus diisi!</div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between mt-3">
                        <button type="submit" class="btn btn-icon icon-left btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        const statusSelect = document.getElementById('status');
        const keteranganGroup = document.getElementById('keterangan-ditolak-group');

        function toggleKeteranganDitolak() {
            if (statusSelect.value === 'ditolak') {
                keteranganGroup.style.display = '';
            } else {
                keteranganGroup.style.display = 'none';
            }
        }

        // Trigger on page load and status change
        toggleKeteranganDitolak();
        statusSelect.addEventListener('change', toggleKeteranganDitolak);
    });
</script> -->
@endsection
