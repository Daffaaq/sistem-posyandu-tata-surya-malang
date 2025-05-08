@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Pemeriksaan Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pemeriksaan.kehamilan.index', $pemeriksaan->kehamilan_id) }}"
                            class="{{ request()->routeIs('pemeriksaan.kehamilan.index') ? 'active' : '' }}">
                            Pemeriksaan Kehamilan
                        </a>
                    </li>
                    <li class="breadcrumb-item active">
                        Edit Data Pemeriksaan
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('pemeriksaan.kehamilan.update', $pemeriksaan->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Tanggal Pemeriksaan -->
                    <div class="form-group">
                        <label for="tanggal_pemeriksaan_kehamilan">Tanggal Pemeriksaan:</label>
                        <input type="date" name="tanggal_pemeriksaan_kehamilan" id="tanggal_pemeriksaan_kehamilan"
                            class="form-control @error('tanggal_pemeriksaan_kehamilan') is-invalid @enderror"
                            value="{{ old('tanggal_pemeriksaan_kehamilan', $pemeriksaan->tanggal_pemeriksaan_kehamilan) }}">
                        @error('tanggal_pemeriksaan_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi Pemeriksaan -->
                    <div class="form-group">
                        <label for="deskripsi_pemeriksaan_kehamilan">Deskripsi Pemeriksaan:</label>
                        <textarea name="deskripsi_pemeriksaan_kehamilan" id="deskripsi_pemeriksaan_kehamilan"
                            class="form-control @error('deskripsi_pemeriksaan_kehamilan') is-invalid @enderror"
                            placeholder="Tuliskan deskripsi pemeriksaan...">{{ old('deskripsi_pemeriksaan_kehamilan', $pemeriksaan->deskripsi_pemeriksaan_kehamilan) }}</textarea>
                        @error('deskripsi_pemeriksaan_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Keluhan -->
                    <div class="form-group">
                        <label for="keluhan_kehamilan">Keluhan:</label>
                        <input type="text" name="keluhan_kehamilan" id="keluhan_kehamilan"
                            class="form-control @error('keluhan_kehamilan') is-invalid @enderror"
                            value="{{ old('keluhan_kehamilan', $pemeriksaan->keluhan_kehamilan) }}"
                            placeholder="Keluhan yang dirasakan (jika ada)">
                        @error('keluhan_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tekanan Darah -->
                    <div class="form-group">
                        <label for="tekanan_darah_ibu_hamil">Tekanan Darah:</label>
                        <input type="text" name="tekanan_darah_ibu_hamil" id="tekanan_darah_ibu_hamil"
                            class="form-control @error('tekanan_darah_ibu_hamil') is-invalid @enderror"
                            value="{{ old('tekanan_darah_ibu_hamil', $pemeriksaan->tekanan_darah_ibu_hamil) }}"
                            placeholder="Contoh: 120/80">
                        @error('tekanan_darah_ibu_hamil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Berat Badan -->
                    <div class="form-group">
                        <label for="berat_badan_ibu_hamil">Berat Badan (kg):</label>
                        <input type="number" name="berat_badan_ibu_hamil" id="berat_badan_ibu_hamil"
                            class="form-control @error('berat_badan_ibu_hamil') is-invalid @enderror"
                            value="{{ old('berat_badan_ibu_hamil', $pemeriksaan->berat_badan_ibu_hamil) }}" step="0.1">
                        @error('berat_badan_ibu_hamil')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Posisi Janin -->
                    <div class="form-group">
                        <label for="posisi_janin">Posisi Janin:</label>
                        <input type="text" name="posisi_janin" id="posisi_janin"
                            class="form-control @error('posisi_janin') is-invalid @enderror"
                            value="{{ old('posisi_janin', $pemeriksaan->posisi_janin) }}">
                        @error('posisi_janin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Usia Kandungan -->
                    <div class="form-group">
                        <label for="usia_kandungan">Usia Kandungan (minggu):</label>
                        <input type="number" name="usia_kandungan" id="usia_kandungan"
                            class="form-control @error('usia_kandungan') is-invalid @enderror"
                            value="{{ old('usia_kandungan', $pemeriksaan->usia_kandungan) }}">
                        @error('usia_kandungan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary"
                                href="{{ route('pemeriksaan.kehamilan.index', $pemeriksaan->kehamilan_id) }}">Cancel</a>
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
