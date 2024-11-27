@extends('layouts.adminbesar.main') 
@section('title', 'Admin Besar Admin') 

@section('content') 
<div class="main-content"> 
    <section class="section"> 
        <div class="section-header"> 
            <h1>Admin List</h1> 
            <div class="section-header-breadcrumb"> 
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}">Dashboard</a>
                </div> 
                <div class="breadcrumb-item">Admin List</div> 
            </div> 
        </div> 

        <!-- Tombol Tambah Admin -->
        <a href="#}" class="btn btn-icon icon-left btn-primary">
            <i class="fas fa-plus"></i> Tambah Admin
        </a>  

        <div class="card mt-3">
            <div class="card-body"> 
                <div class="table-responsive"> 
                    <table class="table table-bordered table-md"> 
                        <thead>
                            <tr> 
                                <th>#</th> 
                                <th>Name</th> 
                                <th>Username</th> 
                                <th>Email</th> 
                                <th>No. WhatsApp</th> 
                                <th>Action</th> 
                            </tr> 
                        </thead>
                        <tbody>
                            @php 
                                $no = 0;
                            @endphp
                            @forelse ($admins as $admin) 
                                <tr> 
                                    <td>{{ ++$no }}</td> 
                                    <td>{{ $admin->name }}</td> 
                                    <td>{{ $admin->username }}</td> 
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->no_wa }}</td>
                                    <td> 
                                        <a href="#" class="badge badge-info">Detail</a>     
                                        <a href="#" class="badge badge-info">Edit</a> 
                                        <a href="#" class="badge badge-danger" data-confirm-delete="true">Hapus</a> 
                                    </td> 
                                </tr> 
                            @empty 
                                <tr>
                                    <td colspan="6" class="text-center">Data Admin Kosong</td> 
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
