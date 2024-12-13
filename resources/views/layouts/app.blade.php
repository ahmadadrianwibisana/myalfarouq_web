<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MyAlfarouq')</title>
    <link rel="stylesheet" href="{{ asset('assets/user/css/main.css') }}">
    <!-- Tambahkan CSS lainnya di sini -->
</head>
<body>
    @include('layouts.header') <!-- Jika Anda memiliki header terpisah -->
    <div class="container">
        @yield('content')
    </div>
    @include('layouts.footer') <!-- Jika Anda memiliki footer terpisah -->
    <script src="{{ asset('assets/user/js/main.js') }}"></script>
    <!-- Tambahkan JS lainnya di sini -->
</body>
</html>