@extends('layouts.admin.main')
@section('title', 'Profil Admin Besar')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Profil Admin Besar</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active">
                    <a href="{{ route('adminbesar.dashboard') }}">Dashboard</a>
                </div>
                <div class="breadcrumb-item">Profil Admin Besar</div>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 text-center">
                        <img src="{{ $adminBesar && $adminBesar->foto ? asset('images/' . $adminBesar->foto) : asset('assets/templates/adminbesar/img/default-avatar.png') }}" 
                            alt="Foto Admin Besar" 
                            class="img-fluid rounded-circle" 
                            style="width: 150px; height: 150px;">
                    </div>
                    <div class="col-12 mt-3">
                        <h4>{{ $adminBesar ? $adminBesar->name : 'N/A' }}</h4>
                        <p><strong>Email:</strong> {{ $adminBesar ? $adminBesar->email : 'N/A' }}</p>
                        <p><strong>Username:</strong> {{ $adminBesar ? $adminBesar->username : 'N/A' }}</p>
                    </div>
                </div>
                <div class="text-right mt-3">
                    <a href="{{ route('adminbesar.profile.edit') }}" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection