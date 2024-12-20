<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alfarouq Travel</title>
    <!-- CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #eaf2f2;
            font-family: 'Arial', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .image-header {
            position: relative;
            width: 100%;
            height: 220px;
            background: url("assets/templates/image/singapura.jpg") no-repeat center center/cover;
        }

        .image-header h2 {
            position: absolute;
            bottom: 15px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            font-size: 1.8rem;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
            text-align: center;
            margin: 0;
            font-weight: bold;
            animation: slideIn 2s ease-in-out;
            cursor: pointer;
        }

        @keyframes slideIn {
            0% {
                transform: translateX(100%);
            }
            50% {
                transform: translateX(-50%);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Animasi Blink saat teks diklik */
        @keyframes blink {
            0% {
                opacity: 1;
            }
            50% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .blink-text {
            animation: none; /* Default tidak ada animasi */
        }

        .image-header h2.clicked {
            animation: blink 1s linear infinite; /* Animasi berkedip saat diklik */
        }

        .form-content {
            padding: 25px;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
            background-color: #f9f9f9;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: #74a99c;
            box-shadow: 0 0 0 0.2rem rgba(116, 169, 156, 0.25);
        }

        .btn-login {
            background-color: #276f5f;
            border: none;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px;
            font-size: 16px;
            width: 100%;
            margin-top: 15px;
            transition: background-color 0.3s ease;
        }

        .btn-login:hover {
            background-color: #133f34;
        }

        .btn-login:focus {
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(19, 63, 52, 0.25);
        }

        @media (max-width: 576px) {
            .login-container {
                max-width: 90%;
                margin: 30px auto;
            }

            .image-header {
                height: 180px;
            }

            .image-header h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <!-- Login Form -->
    <div class="login-container">
        <!-- Image Header with Text -->
        <div class="image-header">
            <h2 id="welcome-text">Welcome To <br> Alfarouq Travel</h2>
        </div>
        <!-- Form Content -->
        <div class="form-content">
            <form action="/post-login" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                </div>
                <div class="form-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Menambahkan event listener pada teks untuk animasi berkedip
        const welcomeText = document.getElementById('welcome-text');
        welcomeText.addEventListener('click', function () {
            this.classList.add('clicked');
        });
    </script>
</body>

</html>
