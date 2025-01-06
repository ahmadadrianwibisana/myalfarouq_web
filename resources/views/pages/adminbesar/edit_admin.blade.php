@extends('layouts.adminbesar.main')

@section('title', 'Edit Admin')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 style="color: #276f5f;">Edit Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item">
                    <a href="{{ route('adminbesar.dashboard') }}" style="color: #276f5f;">Dashboard</a>
                </div>
                <div class ="breadcrumb-item active" style="color: #276f5f;">Edit Admin</div>
            </div>
        </div>

        <div class="card mt-3 shadow">
            <div class="card-body">
                <form action="{{ route('adminbesar.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $admin->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $admin->username }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $admin->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_wa">No WA</label>
                        <input type="text" class="form-control" id="no_wa" name="no_wa" value="{{ $admin->no_wa }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui</button>
                    <a href="{{ route('adminbesar.users_and_admins') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection