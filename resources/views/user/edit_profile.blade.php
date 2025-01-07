<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyAlfarouq - Edit Profil Pengguna</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta http-equiv="X-Frame-Options" content="DENY">

    <!-- Favicons -->
    <link href="{{ asset('assets/user/img/logo.png') }}" rel="icon" />
    <link href="{{ asset('assets/user/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Vendor CSS Files -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        body {
            background-color: #E8F5E9; /* Light green background */
            font-family: 'Arial', sans-serif;
        }
        .profile-header {
            background-color: #4CAF50; /* Darker green */
            padding: 15px;
            font-size: 28px;
            font-weight: bold;
            color: #fff;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-label {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #4CAF50; /* Focus border color */
            box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
        }
        .upload-box {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .upload-box i {
            font-size: 40px;
            color: #4CAF50;
        }
        .upload-box span {
            color: #4CAF50;
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }
        .btn-custom {
            background-color: #4CAF50; /* Button color */
            color: #fff;
            border-radius: 20px;
            padding: 10px 20px;
            border: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #388E3C; /* Darker green on hover */
        }
        .text-danger {
            font-size: 0.9em;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="profile-header">EDIT PROFIL</div>
        <form action="{{ route('user.updateProfile') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-4">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                        @error ('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telepon</label>
                        <input type="text" class="form-control" name="no_telepon" value="{{ old('no_telepon', $user->no_telepon) }}" required>
                        @error('no_telepon')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ubah Password</label>
                        <p><strong>Kosong jika Anda tidak ingin mengubah password.</strong></p>
                        <input type="password" class="form-control" name="password" placeholder="Masukkan password baru">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi password baru">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="upload-box">
                        <i class="fas fa-user-circle"></i>
                        <br>
                        <span>Foto Profil</span>
                        <br>
                        @if($user->image)
                            <img src="{{ asset('images/' . $user->image) }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 100px; height: 100px;">
                        @else
                            <span>Tidak ada gambar</span>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unggah Gambar</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        @error('image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn btn-custom me-2" type="button" onclick="window.history.back();">Kembali</button>
                <button class="btn btn-custom" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>