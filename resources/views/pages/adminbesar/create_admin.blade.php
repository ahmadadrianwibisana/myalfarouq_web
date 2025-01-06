@extends('layouts.adminbesar.main')

@section('title', 'Tambah Admin')

@section('content')
<div class="main-content ">
    <section class="section">
        <div class="section-header">
            <h1 style="color: #276f5f;">Tambah Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;">Dashboard</a>
                </div>
                <div class="breadcrumb-item active" style="color: #276f5f;">Tambah Admin</div>
            </div>
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body">
                <form action="{{ route('adminbesar.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No WA</label>
                        <input type="text" class="form-control" id="no_wa" name="no_wa" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('adminbesar.users_and_admins') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection