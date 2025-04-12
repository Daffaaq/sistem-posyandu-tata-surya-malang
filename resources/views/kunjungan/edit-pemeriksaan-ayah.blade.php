@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pemeriksaan Ayah</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Pemeriksaan Ayah</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kunjungan.update-pemeriksaan-ayah', $pemeriksaanAyah->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Tekanan Darah Ayah -->
                    <div class="form-group">
                        <label for="tekanan_darah_ayah">Tekanan Darah Ayah:</label>
                        <input type="text" name="tekanan_darah_ayah" id="tekanan_darah_ayah"
                            class="form-control @error('tekanan_darah_ayah') is-invalid @enderror"
                            value="{{ old('tekanan_darah_ayah', $pemeriksaanAyah->tekanan_darah_ayah) }}"
                            placeholder="Contoh: 120/80">
                        @error('tekanan_darah_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gula Darah Ayah -->
                    <div class="form-group">
                        <label for="gula_darah_ayah">Gula Darah Ayah (mg/dL):</label>
                        <input type="number" name="gula_darah_ayah" id="gula_darah_ayah"
                            class="form-control @error('gula_darah_ayah') is-invalid @enderror"
                            value="{{ old('gula_darah_ayah', $pemeriksaanAyah->gula_darah_ayah) }}" step="0.01"
                            placeholder="Contoh: 90">
                        @error('gula_darah_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kolesterol Ayah -->
                    <div class="form-group">
                        <label for="kolesterol_ayah">Kolesterol Ayah (mg/dL):</label>
                        <input type="number" name="kolesterol_ayah" id="kolesterol_ayah"
                            class="form-control @error('kolesterol_ayah') is-invalid @enderror"
                            value="{{ old('kolesterol_ayah', $pemeriksaanAyah->kolesterol_ayah) }}" step="0.01"
                            placeholder="Contoh: 180">
                        @error('kolesterol_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Catatan Kesehatan Ayah -->
                    <div class="form-group">
                        <label for="catatan_kesehatan_ayah">Catatan Kesehatan Ayah:</label>
                        <textarea name="catatan_kesehatan_ayah" id="catatan_kesehatan_ayah"
                            class="form-control @error('catatan_kesehatan_ayah') is-invalid @enderror" placeholder="Masukkan catatan kesehatan">{{ old('catatan_kesehatan_ayah', $pemeriksaanAyah->catatan_kesehatan_ayah) }}</textarea>
                        @error('catatan_kesehatan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pemeriksaan Lanjutan -->
                    <div class="form-group">
                        <label for="tanggal_pemeriksaan_lanjutan_ayah">Tanggal Pemeriksaan Lanjutan:</label>
                        <input type="date" name="tanggal_pemeriksaan_lanjutan_ayah"
                            id="tanggal_pemeriksaan_lanjutan_ayah"
                            class="form-control @error('tanggal_pemeriksaan_lanjutan_ayah') is-invalid @enderror"
                            value="{{ old('tanggal_pemeriksaan_lanjutan_ayah', $pemeriksaanAyah->tanggal_pemeriksaan_lanjutan_ayah) }}">
                        @error('tanggal_pemeriksaan_lanjutan_ayah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kunjungan.index') }}">Cancel</a>
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
    </style>
@endpush
