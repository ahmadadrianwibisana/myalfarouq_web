@extends('layouts.adminbesar.main')

@section('title', 'Detail Artikel')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Artikel</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('adminbesar.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('adminbesar.artikel.index') }}">Artikel List</a></div>
                <div class="breadcrumb-item">Detail Artikel</div>
            </div>
        </div>

        <div class="card">
                <div class="mt-4">
                    <a href="{{ route('adminbesar.artikel.index') }}" class="btn btn-warning">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('adminbesar.artikel.edit', $artikel->id) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('adminbesar.artikel.destroy', $artikel->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this article?');">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            <div class="card-body">
                <h5 class="card-title">{{ $artikel->judul_artikel }}</h5>
                <p class="card-text">{{ $artikel->deskripsi }}</p>
                <p class="card-text"><strong>Tanggal Publish:</strong> {{ date('d M Y', strtotime($artikel->tanggal_publish)) }}</p>

                @if ($artikel->images->isNotEmpty())
                    <div class="mt-3">
                        @foreach ($artikel->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Gambar Artikel" class="img-fluid mb-2">
                        @endforeach
                    </div>
                @else
                    <p>Tidak ada gambar untuk artikel ini.</p>
                @endif
            </div>
        </div>
    </section>
</div>
@endsection