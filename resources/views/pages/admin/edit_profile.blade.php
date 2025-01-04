@extends('layouts.admin.main')
@section('title', 'Edit Profil Admin')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Profil Admin</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Edit Profil Admin</div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $admin->name }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username" value="{{ $admin->username }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $admin->email }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="no_wa">No WA</label>
                                <input type="text" class="form-control" name="no_wa" id="no_wa" value="{{ $admin->no_wa }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Leave blank to keep current password">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                            <i class="fas fa-eye" id="eyeIcon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto">Foto Admin</label>
                                <div class="custom-file">
                                    <input class="custom-file-input" name="foto" id="foto" type="file">
                                    <label class="custom-file-label" for="foto">Pilih Foto</label>
                                </div>
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                                @if ($admin->foto) 
                                    <div class="mt-2">
                                        <img src="{{ asset('images/' . $admin->foto) }}" alt="Current Photo" style="max-width: 150px; max-height: 150px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-3">
                        <a href="{{ route('admin.profile') }}" class="btn btn-secondary">Kembali</a> <!-- Back button -->
                        <button type="submit" class="btn btn-primary">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        // Toggle the input type between text and password
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye icon
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle(' fa-eye-slash');
    });
</script>
@endsection