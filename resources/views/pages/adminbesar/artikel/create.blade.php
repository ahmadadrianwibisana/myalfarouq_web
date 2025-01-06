@extends('layouts.adminbesar.main')

@section('title', 'Tambah Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('adminbesar.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('adminbesar.artikel.index') }}">Artikel List</a></div>
                <div class="breadcrumb-item">Tambah Artikel</div>
            </div>
        </div>

        <a href="{{ route('adminbesar.artikel.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('adminbesar.artikel.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="judul_artikel">Judul Artikel</label>
                                <input id="judul_artikel" type="text" class="form-control" name="judul_artikel" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_publish">Tanggal Publish</label>
                                <input id="tanggal_publish" type="date" class="form-control" name="tanggal_publish" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" name="deskripsi" rows="4" required></textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Gambar Artikel</label>
                                <div id="image-container">
                                    <input id="image" type="file" class="form-control" name="image[]" accept="image/*" multiple>
                                    <small class="form-text text-muted">Format gambar yang diizinkan: JPG, PNG.</small>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-image">Tambah Gambar</button>
                            </div>

                            <script>
                                document.getElementById('add-image').addEventListener('click', function() {
                                    // Buat elemen input file baru
                                    var newInput = document.createElement('input');
                                    newInput.type = 'file';
                                    newInput.className = 'form-control mt-2';
                                    newInput.name = 'image[]'; // Pastikan nama tetap sama untuk array
                                    newInput.accept = 'image/*'; // Hanya menerima gambar

                                    // Tambahkan input baru ke dalam container
                                    document.getElementById('image-container').appendChild(newInput);
                                });
                            </script>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-plus"></i> Tambah Artikel
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection