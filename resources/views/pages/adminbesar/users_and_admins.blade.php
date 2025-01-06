@extends('layouts.adminbesar.main') 
@section('title', 'Daftar Pengguna dan Admin') 

@section('content') 
    <div class="main-content"> 
        <section class="section"> 
            <div class="section-header"> 
            <h1 style="color: #276f5f;"><i class="fas fa-users"></i> Daftar Pengguna dan Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;"><i class="fas fa-home"></i> Dashboard</a>
                </div>
                <div class="breadcrumb-item" style="color: #276f5f;">Daftar Pengguna dan Admin</div>
            </div>
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body">
                <h4 class="font-weight-bold" style="color: #276f5f;">Pengguna</h4>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->no_telepon }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3 d-flex justify-content-center">
                        <!-- Previous Page Link -->
                        @if ($users->onFirstPage())
                            <span class="page-link disabled box">Sebelumnya</span>
                        @else
                            <a href="{{ $users->previousPageUrl() }}" class="page-link prev-next box">Sebelumnya</a>
                        @endif

                        <!-- Pagination Links -->
                        <ul class="pagination">
                            @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $users->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Next Page Link -->
                        @if ($users->hasMorePages())
                            <a href="{{ $users->nextPageUrl() }}" class="page-link prev-next box">Selanjutnya</a>
                        @else
                            <span class="page-link disabled box">Selanjutnya</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4 class="font-weight-bold mt-4" style="color: #276f5f;">Admin</h4>
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('adminbesar.create') }}" class="btn btn-primary">Tambah Admin</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead style="background-color: #f8f9fa;">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>No WA</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $index => $admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->no_wa }}</td>
                                    <td>
                                        <a href="{{ route('adminbesar.edit', $admin->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <a href="{{ route('adminbesar.destroy', $admin->id) }}" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection