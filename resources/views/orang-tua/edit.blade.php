@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Orang Tua</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.index') }}"
                            class="{{ request()->routeIs('orang-tua.index') ? 'active' : '' }}">Orang Tua</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.edit', $orangTua->id) }}"
                            class="{{ request()->routeIs('orang-tua.edit') ? 'active' : '' }}">Edit Data Orang Tua</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Form for updating Orang Tua and User Data -->
                <form method="POST" action="{{ route('orang-tua.update', $orangTua->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- User Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                        </div>
                        <div class="card-body">
                            <!-- Name -->
                            <div class="form-group">
                                <label for="name">Nama:</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <!-- Password (optional) -->
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password baru (kosongkan jika tidak diubah)">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Orang Tua Information Card -->
                    <div class="card mb-4">
                        <div class="card-header bg-light">
                            <h6 class="m-0 font-weight-bold text-primary">Orang Tua Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Left Column (Ayah) -->
                                <div class="col-md-6">
                                    <!-- Nama Ayah -->
                                    <div class="form-group">
                                        <label for="nama_ayah">Nama Ayah:</label>
                                        <input type="text" name="nama_ayah" id="nama_ayah"
                                            class="form-control @error('nama_ayah') is-invalid @enderror"
                                            value="{{ old('nama_ayah', $orangTua->nama_ayah) }}">
                                        @error('nama_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir Ayah -->
                                    <div class="form-group">
                                        <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah:</label>
                                        <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah"
                                            class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir_ayah', $orangTua->tanggal_lahir_ayah) }}">
                                        @error('tanggal_lahir_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- No Telepon Ayah -->
                                    <div class="form-group">
                                        <label for="no_telepon_ayah">No Telepon Ayah:</label>
                                        <input type="text" name="no_telepon_ayah" id="no_telepon_ayah"
                                            class="form-control @error('no_telepon_ayah') is-invalid @enderror"
                                            value="{{ old('no_telepon_ayah', $orangTua->no_telepon_ayah) }}">
                                        @error('no_telepon_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Email Ayah -->
                                    <div class="form-group">
                                        <label for="email_ayah">Email Ayah:</label>
                                        <input type="email" name="email_ayah" id="email_ayah"
                                            class="form-control @error('email_ayah') is-invalid @enderror"
                                            value="{{ old('email_ayah', $orangTua->email_ayah) }}">
                                        @error('email_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Pekerjaan Ayah -->
                                    <div class="form-group">
                                        <label for="pekerjaan_ayah">Pekerjaan Ayah:</label>
                                        <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                                            class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                                            value="{{ old('pekerjaan_ayah', $orangTua->pekerjaan_ayah) }}">
                                        @error('pekerjaan_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Agama Ayah -->
                                    <div class="form-group">
                                        <label for="agama_ayah">Agama Ayah:</label>
                                        <select name="agama_ayah" id="agama_ayah"
                                            class="form-control @error('agama_ayah') is-invalid @enderror">
                                            <option value="Islam"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Budha"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Budha' ? 'selected' : '' }}>
                                                Budha</option>
                                            <option value="Konghucu"
                                                {{ old('agama_ayah', $orangTua->agama_ayah) == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                        </select>
                                        @error('agama_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Alamat Ayah -->
                                    <div class="form-group">
                                        <label for="alamat_ayah">Alamat Ayah:</label>
                                        <textarea name="alamat_ayah" id="alamat_ayah" class="form-control @error('alamat_ayah') is-invalid @enderror">{{ old('alamat_ayah', $orangTua->alamat_ayah) }}</textarea>
                                        @error('alamat_ayah')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Right Column (Ibu) -->
                                <div class="col-md-6">
                                    <!-- Nama Ibu -->
                                    <div class="form-group">
                                        <label for="nama_ibu">Nama Ibu:</label>
                                        <input type="text" name="nama_ibu" id="nama_ibu"
                                            class="form-control @error('nama_ibu') is-invalid @enderror"
                                            value="{{ old('nama_ibu', $orangTua->nama_ibu) }}">
                                        @error('nama_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Tanggal Lahir Ibu -->
                                    <div class="form-group">
                                        <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu:</label>
                                        <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu"
                                            class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror"
                                            value="{{ old('tanggal_lahir_ibu', $orangTua->tanggal_lahir_ibu) }}">
                                        @error('tanggal_lahir_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- No Telepon Ibu -->
                                    <div class="form-group">
                                        <label for="no_telepon_ibu">No Telepon Ibu:</label>
                                        <input type="text" name="no_telepon_ibu" id="no_telepon_ibu"
                                            class="form-control @error('no_telepon_ibu') is-invalid @enderror"
                                            value="{{ old('no_telepon_ibu', $orangTua->no_telepon_ibu) }}">
                                        @error('no_telepon_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Email Ibu -->
                                    <div class="form-group">
                                        <label for="email_ibu">Email Ibu:</label>
                                        <input type="email" name="email_ibu" id="email_ibu"
                                            class="form-control @error('email_ibu') is-invalid @enderror"
                                            value="{{ old('email_ibu', $orangTua->email_ibu) }}">
                                        @error('email_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Pekerjaan Ibu -->
                                    <div class="form-group">
                                        <label for="pekerjaan_ibu">Pekerjaan Ibu:</label>
                                        <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                                            class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                                            value="{{ old('pekerjaan_ibu', $orangTua->pekerjaan_ibu) }}">
                                        @error('pekerjaan_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Agama Ibu -->
                                    <div class="form-group">
                                        <label for="agama_ibu">Agama Ibu:</label>
                                        <select name="agama_ibu" id="agama_ibu"
                                            class="form-control @error('agama_ibu') is-invalid @enderror">
                                            <option value="Islam"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Islam' ? 'selected' : '' }}>
                                                Islam</option>
                                            <option value="Kristen"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Kristen' ? 'selected' : '' }}>
                                                Kristen</option>
                                            <option value="Katolik"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Katolik' ? 'selected' : '' }}>
                                                Katolik</option>
                                            <option value="Hindu"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Hindu' ? 'selected' : '' }}>
                                                Hindu</option>
                                            <option value="Budha"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Budha' ? 'selected' : '' }}>
                                                Budha</option>
                                            <option value="Konghucu"
                                                {{ old('agama_ibu', $orangTua->agama_ibu) == 'Konghucu' ? 'selected' : '' }}>
                                                Konghucu</option>
                                        </select>
                                        @error('agama_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <!-- Alamat Ibu -->
                                    <div class="form-group">
                                        <label for="alamat_ibu">Alamat Ibu:</label>
                                        <textarea name="alamat_ibu" id="alamat_ibu" class="form-control @error('alamat_ibu') is-invalid @enderror">{{ old('alamat_ibu', $orangTua->alamat_ibu) }}</textarea>
                                        @error('alamat_ibu')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('orang-tua.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .breadcrumb {
            background-color: transparent;
            padding: 0;
            margin-bottom: 0;
        }

        .breadcrumb-item {
            font-size: 0.875rem;
        }

        .breadcrumb-item a {
            color: #464646;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .breadcrumb-item a.active {
            font-weight: bold;
            color: #007bff;
            pointer-events: none;
        }

        .position-relative {
            position: relative;
        }
    </style>
@endpush
