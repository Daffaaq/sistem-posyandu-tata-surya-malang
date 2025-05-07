@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Data Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kehamilan.index') }}"
                            class="{{ request()->routeIs('kehamilan.index') ? 'active' : '' }}">
                            Data Kehamilan
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Tambah</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kehamilan.store') }}">
                    @csrf

                    {{-- Orang Tua --}}
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua <span class="text-danger">*</span></label>
                        <select name="orang_tua_id" id="orang_tua_id"
                            class="form-control @error('orang_tua_id') is-invalid @enderror">
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach ($orangTuaList as $parent)
                                <option value="{{ $parent->id }}"
                                    {{ old('orang_tua_id') == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->nama_ayah }} & {{ $parent->nama_ibu }}
                                </option>
                            @endforeach
                        </select>
                        @error('orang_tua_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai Kehamilan --}}
                    <div class="form-group">
                        <label for="tanggal_mulai_kehamilan">Tanggal Mulai Kehamilan <span
                                class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai_kehamilan"
                            class="form-control @error('tanggal_mulai_kehamilan') is-invalid @enderror"
                            value="{{ old('tanggal_mulai_kehamilan') }}">
                        @error('tanggal_mulai_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prediksi Tanggal Lahir --}}
                    <div class="form-group">
                        <label for="prediksi_tanggal_lahir">Prediksi Tanggal Lahir <span
                                class="text-danger">*</span></label>
                        <input type="date" name="prediksi_tanggal_lahir"
                            class="form-control @error('prediksi_tanggal_lahir') is-invalid @enderror"
                            value="{{ old('prediksi_tanggal_lahir') }}">
                        @error('prediksi_tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Kehamilan --}}
                    <div class="form-group">
                        <label for="status_kehamilan">Status Kehamilan <span class="text-danger">*</span></label>
                        <select name="status_kehamilan"
                            class="form-control @error('status_kehamilan') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="Hamil" {{ old('status_kehamilan') == 'Hamil' ? 'selected' : '' }}>Hamil
                            </option>
                            <option value="Melahirkan" {{ old('status_kehamilan') == 'Melahirkan' ? 'selected' : '' }}>
                                Melahirkan</option>
                            <option value="Gugur" {{ old('status_kehamilan') == 'Gugur' ? 'selected' : '' }}>Gugur
                            </option>
                        </select>
                        @error('status_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <div class="mb-3">
                        <button class="btn btn-outline-primary" type="button" data-toggle="collapse"
                            data-target="#pemeriksaanCollapse"
                            aria-expanded="{{ old('tanggal_pemeriksaan_kehamilan') ? 'true' : 'false' }}"
                            aria-controls="pemeriksaanCollapse">
                            Tambah Pemeriksaan Kehamilan (Opsional)
                        </button>
                    </div>

                    <div class="collapse {{ old('tanggal_pemeriksaan_kehamilan') ? 'show' : '' }}"
                        id="pemeriksaanCollapse">
                        <div class="card card-body border-left-primary mb-4">

                            {{-- Tanggal Pemeriksaan --}}
                            <div class="form-group">
                                <label for="tanggal_pemeriksaan_kehamilan">Tanggal Pemeriksaan <span
                                        class="text-danger">*</span></label>
                                <input type="date" name="tanggal_pemeriksaan_kehamilan"
                                    class="form-control @error('tanggal_pemeriksaan_kehamilan') is-invalid @enderror"
                                    value="{{ old('tanggal_pemeriksaan_kehamilan') }}">
                                @error('tanggal_pemeriksaan_kehamilan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan tanggal pemeriksaan.</small>
                            </div>

                            {{-- Deskripsi Pemeriksaan --}}
                            <div class="form-group">
                                <label for="deskripsi_pemeriksaan_kehamilan">Deskripsi Pemeriksaan <span
                                        class="text-danger">*</span></label>
                                <textarea name="deskripsi_pemeriksaan_kehamilan"
                                    class="form-control @error('deskripsi_pemeriksaan_kehamilan') is-invalid @enderror"
                                    placeholder="Masukkan deskripsi pemeriksaan">{{ old('deskripsi_pemeriksaan_kehamilan') }}</textarea>
                                @error('deskripsi_pemeriksaan_kehamilan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Deskripsi pemeriksaan untuk referensi medis.</small>
                            </div>

                            {{-- Keluhan --}}
                            <div class="form-group">
                                <label for="keluhan_kehamilan">Keluhan</label>
                                <textarea name="keluhan_kehamilan" class="form-control @error('keluhan_kehamilan') is-invalid @enderror"
                                    placeholder="Masukkan keluhan (opsional)">{{ old('keluhan_kehamilan') }}</textarea>
                                @error('keluhan_kehamilan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan keluhan ibu hamil jika ada (opsional).</small>
                            </div>

                            {{-- Tekanan Darah --}}
                            <div class="form-group">
                                <label for="tekanan_darah_ibu_hamil">Tekanan Darah <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="tekanan_darah_ibu_hamil"
                                    class="form-control @error('tekanan_darah_ibu_hamil') is-invalid @enderror"
                                    placeholder="Contoh: 120/80" value="{{ old('tekanan_darah_ibu_hamil') }}">
                                @error('tekanan_darah_ibu_hamil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan tekanan darah ibu hamil, contoh:
                                    120/80.</small>
                            </div>

                            {{-- Berat Badan --}}
                            <div class="form-group">
                                <label for="berat_badan_ibu_hamil">Berat Badan (kg) <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.1" min="30" max="10000"
                                    name="berat_badan_ibu_hamil"
                                    class="form-control @error('berat_badan_ibu_hamil') is-invalid @enderror"
                                    placeholder="Contoh: 45.5" value="{{ old('berat_badan_ibu_hamil') }}">
                                @error('berat_badan_ibu_hamil')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan berat badan ibu hamil dalam kilogram
                                    (kg).</small>
                            </div>

                            {{-- Posisi Janin --}}
                            <div class="form-group">
                                <label for="posisi_janin">Posisi Janin <span class="text-danger">*</span></label>
                                <input type="text" name="posisi_janin"
                                    class="form-control @error('posisi_janin') is-invalid @enderror"
                                    value="{{ old('posisi_janin') }}">
                                @error('posisi_janin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan posisi janin, contoh: kepala di bawah.</small>
                            </div>

                            {{-- Usia Kandungan --}}
                            <div class="form-group">
                                <label for="usia_kandungan">Usia Kandungan (minggu) <span
                                        class="text-danger">*</span></label>
                                <input type="number" name="usia_kandungan" min="1" max="42"
                                    class="form-control @error('usia_kandungan') is-invalid @enderror"
                                    placeholder="Contoh: 12" value="{{ old('usia_kandungan') }}">
                                @error('usia_kandungan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Masukkan usia kandungan dalam minggu (maksimal 42
                                    minggu).</small>
                            </div>

                        </div>
                    </div>
                    {{-- Buttons --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kehamilan.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#orang_tua_id').select2({
                placeholder: "-- Pilih Orang Tua --",
                allowClear: true
            });
        });
    </script>
@endpush
