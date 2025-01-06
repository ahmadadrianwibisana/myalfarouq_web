<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
    </style>
</head>
<body>
    <div class="container">
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <h2>Reset Password</h2>
            <p>Masukkan alamat email Anda dan kami akan mengirimkan link untuk mereset password Anda.</p>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Link Reset Password</button>
            <p class="mt-3"><a href="{{ url('/login') }}">Kembali ke Login</a></p>
        </form>
    </div> 
</body> 
</html>