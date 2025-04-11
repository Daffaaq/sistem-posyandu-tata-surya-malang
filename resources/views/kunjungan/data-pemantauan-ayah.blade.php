@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan Ayah</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.index') }}"
                            class="{{ request()->routeIs('orang-tua.index') ? 'active' : '' }}">Orang Tua</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Ayah</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Tekanan Darah Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tekanan Darah ayah</h5>
                            <p>{{ $pemeriksaanOrangTua->tekanan_darah_ayah }} mmHg</p>
                        </div>
                    </div>

                    <!-- Gula Darah ayah -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Gula Darah ayah</h5>
                            <p>{{ $pemeriksaanOrangTua->gula_darah_ayah }} mg/dl</p>
                        </div>
                    </div>

                    <!-- Kolesterol ayah -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Kolesterol ayah</h5>
                            <p>{{ $pemeriksaanOrangTua->kolesterol_ayah }} mg/dl</p>
                        </div>
                    </div>

                    <!-- Catatan Kesehatan ayah -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Catatan Kesehatan ayah</h5>
                            <p>{{ $pemeriksaanOrangTua->catatan_kesehatan_ayah }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Pemeriksaan ayah -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tanggal Pemeriksaan ayah</h5>
                            <p>{{ \Carbon\Carbon::parse($pemeriksaanOrangTua->tanggal_pemeriksaan_ayah)->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Tanggal Pemeriksaan Lanjutan ayah -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tanggal Pemeriksaan Lanjutan ayah</h5>
                            <p>{{ \Carbon\Carbon::parse($pemeriksaanOrangTua->tanggal_pemeriksaan_lanjutan_ayah)->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="btn-group" role="group" aria-label="User Action">
                            <a href="{{ route('kunjungan.index') }}" class="btn btn-sm btn-secondary rounded-pill px-4 py-2"
                                data-toggle="tooltip" data-placement="top" title="Kembali">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
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
