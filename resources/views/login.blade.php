<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url("assets/img/background.png");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            background-color: transparent;
            max-width: 500px;
            text-align: center;
            padding: 0;
        }

        .form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        .logo {
            max-width: 180px;
            margin: 0 auto 60px;
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form__input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            font-size: 14px;
            box-shadow: none;
            outline: none;
            transition: border 0.3s;
        }

        .form__input:focus {
            border-color: #276f5f;
        }

        .btn-primary {
            background-color: #276f5f;
            color: #fff;
            border: none;
            border-radius: 8px;
            width: 100%;
            padding: 12px 0;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #205d4e;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 14px;
            margin-bottom: 15px;
        }

        .remember-forgot a {
            color: #276f5f;
            text-decoration: none;
        }

        .remember-forgot a:hover {
            text-decoration: underline;
        }

        .google-btn {
            margin-top: 15px;
            background: white;
            border: 1px solid #ced4da;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            padding: 10px;
            width: 100%;
            transition: background-color 0.3s;
        }

        .google-btn img {
            width: 20px;
            margin-right: 8px;
        }

        .google-btn:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="container">
        <form class="form" action="/post-login" method="POST" id="contactForm" novalidate="novalidate">
        @csrf
            <a href="{{ url('/') }}">
                <img class="logo" src="assets/img/logoalfarouq.png" alt="Logo Alfarouq Travel">
            </a>
            <div class="form-group">
            <input type="email" class="form-control" id="email" name="email"
            placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'">
            </div>
            <div class="form-group">
            <input type="password" class="form-control" id="password" name="password"
            placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
            </div>
            <div class="remember-forgot">
                <a href="{{ route('password.request') }}">Lupa Password?</a>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="mt-3">Belum punya akun? 
            <a href="/register">Daftar</a></p>
            <div class="divider">Atau masuk dengan</div>
            <a href="{{ route('google.login') }}" class="google-btn">
                <img src="assets/img/logogoogle.png" alt="Google">
                Masuk dengan Google
            </a>
        </form>
    </div>
</body>
</html>

