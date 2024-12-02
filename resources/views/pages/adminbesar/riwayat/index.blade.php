@extends('layouts.adminbesar.main')

@section('title', 'Riwayat')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Riwayat</h1>
        </div>
        <div class="card mt-4">
            <div class="card-body">
                @if($riwayats->isEmpty())
                    <div class="alert alert-warning">Tidak ada riwayat yang tersedia.</div>
                @else
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Pemesanan</th>
                                <th>ID Pembayaran</th>
                                <th>Dokumen</th> <!-- Mengganti ID Data Administrasi dengan Dokumen -->
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($riwayats as $riwayat)
                                <tr>
                                    <td>{{ $riwayat->pemesanan_id }}</td>
                                    <td>{{ $riwayat->pembayaran_id }}</td>
                                    <td>{{ $riwayat->data_administrasi_id }}</td> <!-- Anda bisa mengganti ini dengan data yang lebih informatif -->
                                    <td>{{ $riwayat->created_at->format('d-m-Y H:i:s') }}</td>
                                    <td>
                                        <a href="{{ route('adminbesar.riwayat.show', $riwayat->id) }}" class="btn btn-info">Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Menambahkan pagination -->
                    {{ $riwayats->links() }}
                @endif
            </div>
        </div>
    </section>
</div>
@endsection