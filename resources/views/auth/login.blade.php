<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Posyandu Tata Surya Kota Malang">
    <meta name="author" content="">

    <title>Sistem Posyandu Tata Surya - Login</title>

    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f1f5f8;
            font-family: 'Nunito', sans-serif;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-card {
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
        }

        .login-card .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-card .logo img {
            max-width: 150px;
        }

        .login-card h4 {
            color: #333;
            text-align: center;
            margin-bottom: 25px;
            font-size: 22px;
        }

        .login-card .form-control {
            border-radius: 30px;
            padding: 20px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .login-card button {
            background: #007bff;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 30px;
            font-size: 16px;
        }

        .login-card button:hover {
            background: #0056b3;
        }

        .login-card .small {
            color: #6c757d;
            text-align: center;
            display: block;
            margin-top: 15px;
        }

        .login-card .small a {
            color: #007bff;
            text-decoration: none;
        }

        .login-card .small a:hover {
            text-decoration: underline;
        }

        /* Responsive for small devices */
        @media (max-width: 576px) {
            .login-card {
                padding: 25px;
            }

            .login-card h4 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="logo">
                <!-- Logo can go here -->
                <img src="https://via.placeholder.com/150x50.png?text=Logo" alt="Sistem Posyandu Tata Surya">
            </div>
            <h4>Sistem Posyandu Tata Surya - Login</h4>

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Email Input -->
                <div class="form-group">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        id="email" placeholder="Masukkan Email Anda" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Password Input -->
                <div class="form-group">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password" placeholder="Kata Sandi" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Login Button -->
                <button type="submit">Masuk</button>
            </form>
            <div class="small">
                <a href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
            </div>
            <div class="small">
                <a href="{{ route('register') }}">Buat Akun Baru!</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
