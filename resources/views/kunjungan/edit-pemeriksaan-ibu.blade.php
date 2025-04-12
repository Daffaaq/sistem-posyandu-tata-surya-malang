@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pemeriksaan Ibu</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item active">Edit Pemeriksaan Ibu</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kunjungan.update-pemeriksaan-ibu', $pemeriksaanIbu->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Tekanan Darah Ibu -->
                    <div class="form-group">
                        <label for="tekanan_darah_ibu">Tekanan Darah Ibu:</label>
                        <input type="text" name="tekanan_darah_ibu" id="tekanan_darah_ibu"
                            class="form-control @error('tekanan_darah_ibu') is-invalid @enderror"
                            value="{{ old('tekanan_darah_ibu', $pemeriksaanIbu->tekanan_darah_ibu) }}"
                            placeholder="Contoh: 110/70">
                        @error('tekanan_darah_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gula Darah Ibu -->
                    <div class="form-group">
                        <label for="gula_darah_ibu">Gula Darah Ibu (mg/dL):</label>
                        <input type="number" name="gula_darah_ibu" id="gula_darah_ibu"
                            class="form-control @error('gula_darah_ibu') is-invalid @enderror"
                            value="{{ old('gula_darah_ibu', $pemeriksaanIbu->gula_darah_ibu) }}" step="0.01"
                            placeholder="Contoh: 95">
                        @error('gula_darah_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kolesterol Ibu -->
                    <div class="form-group">
                        <label for="kolesterol_ibu">Kolesterol Ibu (mg/dL):</label>
                        <input type="number" name="kolesterol_ibu" id="kolesterol_ibu"
                            class="form-control @error('kolesterol_ibu') is-invalid @enderror"
                            value="{{ old('kolesterol_ibu', $pemeriksaanIbu->kolesterol_ibu) }}" step="0.01"
                            placeholder="Contoh: 190">
                        @error('kolesterol_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Catatan Kesehatan Ibu -->
                    <div class="form-group">
                        <label for="catatan_kesehatan_ibu">Catatan Kesehatan Ibu:</label>
                        <textarea name="catatan_kesehatan_ibu" id="catatan_kesehatan_ibu"
                            class="form-control @error('catatan_kesehatan_ibu') is-invalid @enderror" placeholder="Masukkan catatan kesehatan">{{ old('catatan_kesehatan_ibu', $pemeriksaanIbu->catatan_kesehatan_ibu) }}</textarea>
                        @error('catatan_kesehatan_ibu')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Pemeriksaan Lanjutan -->
                    <div class="form-group">
                        <label for="tanggal_pemeriksaan_lanjutan_ibu">Tanggal Pemeriksaan Lanjutan:</label>
                        <input type="date" name="tanggal_pemeriksaan_lanjutan_ibu" id="tanggal_pemeriksaan_lanjutan_ibu"
                            class="form-control @error('tanggal_pemeriksaan_lanjutan_ibu') is-invalid @enderror"
                            value="{{ old('tanggal_pemeriksaan_lanjutan_ibu', $pemeriksaanIbu->tanggal_pemeriksaan_lanjutan_ibu) }}">
                        @error('tanggal_pemeriksaan_lanjutan_ibu')
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
