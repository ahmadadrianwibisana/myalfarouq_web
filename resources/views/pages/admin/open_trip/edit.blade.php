@extends('layouts.admin.main')
@section('title', 'Admin Edit Open Trip')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Open Trip</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item active"><a href="{{ route('admin.open_trip.index') }}">Open Trip</a></div>
                <div class="breadcrumb-item">Edit Open Trip</div>
            </div>
        </div>
        <a href="{{ route('admin.open_trip.index') }}" class="btn btn-icon icon-left btn-warning">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="card mt-4">
            <form action="{{ route('admin.open_trip.update', $openTrip->id) }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate="">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_paket">Nama Paket</label>
                                <input id="nama_paket" type="text" class="form-control" name="nama_paket" required value="{{ $openTrip->nama_paket }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_berangkat">Tanggal Berangkat</label>
                                <input id="tanggal_berangkat" type="date" class="form-control" name="tanggal_berangkat" required value="{{ $openTrip->tanggal_berangkat }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lama_keberangkatan">Lama Keberangkatan</label>
                                <input id="lama_keberangkatan" type="text" class="form-control" name="lama_keberangkatan" required value="{{ $openTrip->lama_keberangkatan }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input id="harga" type="number" class="form-control" name="harga" required value="{{ $openTrip->harga }}" step="0.01">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kuota">Kuota</label>
                                <input id="kuota" type="number" class="form-control" name="kuota" required value="{{ $openTrip->kuota }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="destinasi">Destinasi</label>
                                <input id="destinasi" type="text" class="form-control" name="destinasi" required value="{{ $openTrip->destinasi }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pulang">Tanggal Pulang</label>
                                <input id="tanggal_pulang" type="date" class="form-control" name="tanggal_pulang" required value="{{ $openTrip->tanggal_pulang }}">
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="star_point">Star Point</label>
                                <input id="star_point" type="text" class="form-control" name="star_point" value="{{ old('star_point', $openTrip->star_point) }}" required>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Gambar</label>
                                <input id="image" type="file" class="form-control" name="image" accept="image/*">
                                
                                @if($openTrip->image)
                                    @php
                                        $oldPath = public_path('open_trip_images/' . $openTrip->image);
                                    @endphp

                                    @if(file_exists($oldPath))
                                        <div class="mt-2">
                                            <img src="{{ asset('open_trip_images/' . $openTrip->image) }}" alt="Trip Image" width="100">
                                        </div>
                                    @else
                                        <div class="mt-2 text-danger">
                                            Gambar tidak ditemukan.
                                        </div>
                                    @endif
                                @endif
                                
                                <small class="form-text text-muted">Format gambar yang diizinkan: JPG, PNG.</small>
                            </div>
                            <div class="form-group">
                                <label for="include">Include</label>
                                <textarea id="include" class="form-control" name="include" rows="4" required>{{ $openTrip->include }}</textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exclude">Exclude</label>
                                <textarea id="exclude" class="form-control" name="exclude" rows="4" required>{{ $openTrip->exclude }}</textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="file">File (Dokumen)</label>
                                <input id="file" type="file" class="form-control" name="file" accept=".pdf,.doc,.docx">
                                <small class="form-text text-muted">Format file yang diizinkan: PDF, DOC, DOCX.</small>
                                @if($openTrip->file)
                                    <div class="mt-2">
                                        <a href="{{ asset('open_trip_files/' . $openTrip->file) }}" target="_blank">Lihat Dokumen</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="deskripsi_trip">Deskripsi Trip</label>
                                <textarea id="deskripsi_trip" class="form-control" name="deskripsi_trip" rows="4" required>{{ $openTrip->deskripsi_trip }}</textarea>
                                <div class="invalid-feedback">
                                    Kolom ini harus diisi!
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-icon icon-left btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection