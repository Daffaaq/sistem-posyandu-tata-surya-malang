@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pemantauan Tumbuh Kembang Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.form-edit-pantauan-tumbuh-kembang-anak', $pemantauanTumbuhKembangAnak->id) }}"
                            class="{{ request()->routeIs('kunjungan.form-edit-pantauan-tumbuh-kembang-anak') ? 'active' : '' }}">
                            Edit Pemantauan Tumbuh Kembang
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Form Edit Pemantauan -->
                <form method="POST"
                    action="{{ route('kunjungan.update-pantauan-tumbuh-kembang-anak', $pemantauanTumbuhKembangAnak->id) }}">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->

                    <!-- Tinggi Badan -->
                    <div class="form-group">
                        <label for="tinggi_badan">Tinggi Badan (cm):</label>
                        <input type="number" step="0.01" name="tinggi_badan" id="tinggi_badan"
                            placeholder="Tinggi Badan" class="form-control @error('tinggi_badan') is-invalid @enderror"
                            value="{{ old('tinggi_badan', $pemantauanTumbuhKembangAnak->tinggi_badan) }}">
                        @error('tinggi_badan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Berat Badan -->
                    <div class="form-group">
                        <label for="berat_badan">Berat Badan (kg):</label>
                        <input type="number" step="0.01" name="berat_badan" id="berat_badan" placeholder="Berat Badan"
                            class="form-control @error('berat_badan') is-invalid @enderror"
                            value="{{ old('berat_badan', $pemantauanTumbuhKembangAnak->berat_badan) }}">
                        @error('berat_badan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Perkembangan Motorik -->
                    <div class="form-group">
                        <label for="perkembangan_motorik">Perkembangan Motorik:</label>
                        <textarea name="perkembangan_motorik" id="perkembangan_motorik" placeholder="Deskripsi motorik"
                            class="form-control @error('perkembangan_motorik') is-invalid @enderror">{{ old('perkembangan_motorik', $pemantauanTumbuhKembangAnak->perkembangan_motorik) }}</textarea>
                        @error('perkembangan_motorik')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Perkembangan Psikis -->
                    <div class="form-group">
                        <label for="perkembangan_psikis">Perkembangan Psikis:</label>
                        <textarea name="perkembangan_psikis" id="perkembangan_psikis" placeholder="Deskripsi psikis"
                            class="form-control @error('perkembangan_psikis') is-invalid @enderror">{{ old('perkembangan_psikis', $pemantauanTumbuhKembangAnak->perkembangan_psikis) }}</textarea>
                        @error('perkembangan_psikis')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tombol Submit -->
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
