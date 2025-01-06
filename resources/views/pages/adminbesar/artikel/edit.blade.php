@extends('layouts.adminbesar.main')

@section('title', 'Edit Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('adminbesar.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('adminbesar.artikel.index') }}">Artikel List</a></div>
                <div class="breadcrumb-item">Edit Artikel</div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('adminbesar.artikel.update', $artikel->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="judul_artikel">Judul Artikel</label>
                        <input type="text" class="form-control @error('judul_artikel') is-invalid @enderror" id="judul_artikel" name="judul_artikel" value="{{ old('judul_artikel', $artikel->judul_artikel) }}" required>
                        @error('judul_artikel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $artikel->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_publish">Tanggal Publish</label>
                        <input type="date" class="form-control @error('tanggal_publish') is-invalid @enderror" id="tanggal_publish" name="tanggal_publish" value="{{ old('tanggal_publish', $artikel->tanggal_publish) }}" required>
                        @error('tanggal_publish')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror </div>

                    <div class="form-group">
                        <label for="image">Gambar (Opsional)</label>
                        <div id="image-container">
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image[]" accept="image/*" multiple>
                            <small class="form-text text-muted">Format gambar yang diizinkan: JPG, PNG.</small>
                        </div>
                        <button type="button" class="btn btn-secondary mt-2" id="add-image">Tambah Gambar</button>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        @if ($artikel->images()->exists())
                            <div class="mt-2">
                                <h5>Gambar Saat Ini:</h5>
                                <div class="row">
                                    @foreach($artikel->images as $image)
                                        <div class="col-md-4">
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Artikel" class="img-thumbnail" width="150">
                                            <div>
                                                <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"> Hapus
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('adminbesar.artikel.index') }}" class="btn btn-warning">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('add-image').addEventListener('click', function() {
        var newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.className = 'form-control mt-2';
        newInput.name = 'image[]';
        newInput.accept = 'image/*';

        document.getElementById('image-container').appendChild(newInput);
    });
</script>
@endsection