<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Register Orang Tua') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 3rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 0.375rem;
        }

        .btn-primary {
            background-color: #4caf50;
            border: none;
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 1.1rem;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-radius: 0.375rem;
            padding: 0.75rem;
            font-size: 1rem;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .invalid-feedback {
            color: red;
        }

        h3 {
            font-size: 1.75rem;
            color: #343a40;
        }

        h4,
        h5 {
            font-size: 1.25rem;
            color: #495057;
        }

        .form-row {
            margin-bottom: 1.5rem;
        }

        .col-md-6 {
            padding-left: 10px;
            padding-right: 10px;
        }

        .bg-white {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 2rem;
        }

        hr {
            margin: 2rem 0;
        }

        .form-group label {
            font-weight: 600;
        }

        .remove-child {
            margin-top: 1rem;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .col-md-6 {
                padding-left: 5px;
                padding-right: 5px;
            }

            .form-group label {
                font-size: 0.95rem;
            }

            .btn-primary,
            .btn-secondary {
                font-size: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Removed card, using simple div -->
                <div class="bg-white p-4 rounded shadow-sm">
                    <div class="text-center mb-4">
                        <h3>{{ __('Register Orang Tua') }}</h3>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h4>Data Akun</h4>

                        <div class="form-row">
                            <!-- Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">{{ __('Nama Pengguna') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">{{ __('Konfirmasi Password') }}</label>
                            <input id="password_confirmation" type="password" class="form-control"
                                name="password_confirmation" required>
                        </div>
                        <hr>
                        <!-- Ayah and Ibu Details -->
                        <h4>Data Orang Tua</h4>

                        <div class="form-row">
                            <!-- Ayah Details -->
                            <div class="col-md-6">
                                <h5>Data Ayah</h5>

                                <div class="form-group">
                                    <label for="nama_ayah">{{ __('Nama Ayah') }}</label>
                                    <input id="nama_ayah" type="text"
                                        class="form-control @error('nama_ayah') is-invalid @enderror" name="nama_ayah"
                                        value="{{ old('nama_ayah') }}" required autofocus>
                                    @error('nama_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir_ayah">{{ __('Tanggal Lahir Ayah') }}</label>
                                    <input id="tanggal_lahir_ayah" type="date"
                                        class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror"
                                        name="tanggal_lahir_ayah" value="{{ old('tanggal_lahir_ayah') }}" required>
                                    @error('tanggal_lahir_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_telepon_ayah">{{ __('No Telepon Ayah') }}</label>
                                    <input id="no_telepon_ayah" type="text"
                                        class="form-control @error('no_telepon_ayah') is-invalid @enderror"
                                        name="no_telepon_ayah" value="{{ old('no_telepon_ayah') }}" required>
                                    @error('no_telepon_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email_ayah">{{ __('Email Ayah') }}</label>
                                    <input id="email_ayah" type="email"
                                        class="form-control @error('email_ayah') is-invalid @enderror" name="email_ayah"
                                        value="{{ old('email_ayah') }}" required>
                                    @error('email_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan_ayah">{{ __('Pekerjaan Ayah') }}</label>
                                    <input id="pekerjaan_ayah" type="text"
                                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                        name="pekerjaan_ayah" value="{{ old('pekerjaan_ayah') }}" required>
                                    @error('pekerjaan_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agama_ayah">{{ __('Agama Ayah') }}</label>
                                    <select id="agama_ayah"
                                        class="form-control @error('agama_ayah') is-invalid @enderror"
                                        name="agama_ayah" required>
                                        <option value="Islam" {{ old('agama_ayah') == 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Kristen"
                                            {{ old('agama_ayah') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik"
                                            {{ old('agama_ayah') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ old('agama_ayah') == 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Budha" {{ old('agama_ayah') == 'Budha' ? 'selected' : '' }}>
                                            Budha</option>
                                        <option value="Konghucu"
                                            {{ old('agama_ayah') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                    @error('agama_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat_ayah">{{ __('Alamat Ayah') }}</label>
                                    <textarea id="alamat_ayah" class="form-control @error('alamat_ayah') is-invalid @enderror" name="alamat_ayah"
                                        required>{{ old('alamat_ayah') }}</textarea>
                                    @error('alamat_ayah')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ibu Details -->
                            <div class="col-md-6">
                                <h5>Data Ibu</h5>

                                <div class="form-group">
                                    <label for="nama_ibu">{{ __('Nama Ibu') }}</label>
                                    <input id="nama_ibu" type="text"
                                        class="form-control @error('nama_ibu') is-invalid @enderror" name="nama_ibu"
                                        value="{{ old('nama_ibu') }}" required>
                                    @error('nama_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_lahir_ibu">{{ __('Tanggal Lahir Ibu') }}</label>
                                    <input id="tanggal_lahir_ibu" type="date"
                                        class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror"
                                        name="tanggal_lahir_ibu" value="{{ old('tanggal_lahir_ibu') }}" required>
                                    @error('tanggal_lahir_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_telepon_ibu">{{ __('No Telepon Ibu') }}</label>
                                    <input id="no_telepon_ibu" type="text"
                                        class="form-control @error('no_telepon_ibu') is-invalid @enderror"
                                        name="no_telepon_ibu" value="{{ old('no_telepon_ibu') }}" required>
                                    @error('no_telepon_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email_ibu">{{ __('Email Ibu') }}</label>
                                    <input id="email_ibu" type="email"
                                        class="form-control @error('email_ibu') is-invalid @enderror"
                                        name="email_ibu" value="{{ old('email_ibu') }}" required>
                                    @error('email_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan_ibu">{{ __('Pekerjaan Ibu') }}</label>
                                    <input id="pekerjaan_ibu" type="text"
                                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                        name="pekerjaan_ibu" value="{{ old('pekerjaan_ibu') }}" required>
                                    @error('pekerjaan_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="agama_ibu">{{ __('Agama Ibu') }}</label>
                                    <select id="agama_ibu"
                                        class="form-control @error('agama_ibu') is-invalid @enderror"
                                        name="agama_ibu" required>
                                        <option value="Islam" {{ old('agama_ibu') == 'Islam' ? 'selected' : '' }}>
                                            Islam</option>
                                        <option value="Kristen" {{ old('agama_ibu') == 'Kristen' ? 'selected' : '' }}>
                                            Kristen</option>
                                        <option value="Katolik" {{ old('agama_ibu') == 'Katolik' ? 'selected' : '' }}>
                                            Katolik</option>
                                        <option value="Hindu" {{ old('agama_ibu') == 'Hindu' ? 'selected' : '' }}>
                                            Hindu</option>
                                        <option value="Budha" {{ old('agama_ibu') == 'Budha' ? 'selected' : '' }}>
                                            Budha</option>
                                        <option value="Konghucu"
                                            {{ old('agama_ibu') == 'Konghucu' ? 'selected' : '' }}>Konghucu
                                        </option>
                                    </select>
                                    @error('agama_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="alamat_ibu">{{ __('Alamat Ibu') }}</label>
                                    <textarea id="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror" name="alamat_ibu" required>{{ old('alamat_ibu') }}</textarea>
                                    @error('alamat_ibu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <hr>
                        <button type="submit" class="btn btn-primary btn-block">{{ __('Register') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
