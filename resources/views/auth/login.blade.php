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
            background: url('{{ asset('sb-admin/img/6690418.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Nunito', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            position: relative;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            flex-direction: column;
            position: relative;
            z-index: 1;
        }

        .login-card {
            background: linear-gradient(rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.7));
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            padding: 40px 30px;
            width: 100%;
            max-width: 400px;
            z-index: 2;
        }

        .login-card .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-card .logo h4 {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .login-card .logo img {
            max-width: 150px;
            border-radius: 50%;
            border: 5px solid #007bff;
            padding: 5px;
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
        <!-- Form login -->
        <div class="login-card">
            <div class="logo">
                <!-- Judul di atas gambar -->
                <h4 class="tittle">Hari Pahlawan</h4>
                <!-- Lingkaran kosong yang nanti akan diisi dengan gambar -->
                <div
                    style="width: 150px; height: 150px; border-radius: 50%; background-color: #f1f1f1; margin: 0 auto; overflow: hidden;">
                    <!-- Gambar di dalam lingkaran -->
                    <img src="{{ asset('sb-admin/img/4453702.jpg') }}" alt="Logo"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            <h4>Sistem Posyandu Tata Surya</h4>

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
