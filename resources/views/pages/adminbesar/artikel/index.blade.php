@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Artikel') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Artikel List</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Artikel List</div> 
            </div> 
        </div> 

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Button to Add New Article -->
        <a href="{{ route('adminbesar.artikel.create') }}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Artikel
        </a>

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>Judul Artikel</th> 
                                <th>Deskripsi</th> 
                                <th>Tanggal Publish</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($artikels as $artikel) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $artikel->judul_artikel }}</td> 
                                    <td>{{ $artikel->deskripsi }}</td> 
                                    <td>{{ date('d M Y', strtotime($artikel->tanggal_publish)) }}</td>
                                    <td>
                                        <a href="{{ route('adminbesar.artikel.show', $artikel->id) }}" class="badge badge-info">Detail</a>
                                        <!-- <a href="{{ route('adminbesar.artikel.edit', $artikel->id) }}" class="badge badge-warning">Edit</a>
                                        <form action="{{ route('adminbesar.artikel.destroy', $artikel->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge badge-danger" onclick="return confirm('Are you sure you want to delete this article?');">Hapus</button>
                                        </form> -->
                                    </td>
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="6" class="text-center">Data Artikel Kosong</td> 
                                </tr>
                            @endforelse 
                        </tbody>
                    </table> 
                </div> 
            </div> 
        </div>
    </section> 
</div> 
@endsection
