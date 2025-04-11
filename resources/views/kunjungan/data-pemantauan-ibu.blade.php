@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pemeriksaan Ibu</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.index') }}"
                            class="{{ request()->routeIs('orang-tua.index') ? 'active' : '' }}">Orang Tua</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Pemeriksaan Ibu</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Tekanan Darah Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tekanan Darah Ibu</h5>
                            <p>{{ $pemeriksaanOrangTua->tekanan_darah_ibu }} mmHg</p>
                        </div>
                    </div>

                    <!-- Gula Darah Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Gula Darah Ibu</h5>
                            <p>{{ $pemeriksaanOrangTua->gula_darah_ibu }} mg/dl</p> <!-- Menambahkan mg/dl -->
                        </div>
                    </div>

                    <!-- Kolesterol Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Kolesterol Ibu</h5>
                            <p>{{ $pemeriksaanOrangTua->kolesterol_ibu }} mg/dl</p> <!-- Menambahkan mg/dl -->
                        </div>
                    </div>

                    <!-- Catatan Kesehatan Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Catatan Kesehatan Ibu</h5>
                            <p>{{ $pemeriksaanOrangTua->catatan_kesehatan_ibu }}</p>
                        </div>
                    </div>

                    <!-- Tanggal Pemeriksaan Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tanggal Pemeriksaan Ibu</h5>
                            <p>{{ \Carbon\Carbon::parse($pemeriksaanOrangTua->tanggal_pemeriksaan_ibu)->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Tanggal Pemeriksaan Lanjutan Ibu -->
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm p-3 rounded border-light">
                            <h5 class="font-weight-bold text-dark">Tanggal Pemeriksaan Lanjutan Ibu</h5>
                            <p>{{ \Carbon\Carbon::parse($pemeriksaanOrangTua->tanggal_pemeriksaan_lanjutan_ibu)->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>
                </div>


                <hr>

                <!-- Action Buttons -->
                <div class="row mt-4">
                    <div class="col-md-12 text-center">
                        <div class="btn-group" role="group" aria-label="User Action">
                            <a href="{{ route('kunjungan.index') }}" class="btn btn-primary rounded-pill px-4 py-2"
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

        .card-body h5 {
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 10px;
        }

        .card-body p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #f8f9fc;
        }

        .card {
            border: none;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653b7;
        }

        .text-dark {
            color: #212529 !important;
        }

        .font-weight-bold {
            font-weight: 700;
        }

        .breadcrumb-item.active {
            color: #007bff;
        }
    </style>
@endpush
