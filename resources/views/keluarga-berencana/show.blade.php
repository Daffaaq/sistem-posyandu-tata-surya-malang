@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h4 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-user-shield mr-2"></i>Detail Keluarga Berencana
                </h4>
                <ol class="breadcrumb mb-0 bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('keluarga-berencana.index') }}"
                            class="{{ request()->routeIs('keluarga-berencana.index') ? 'active' : '' }}">
                            Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="row">

                    <!-- Orang Tua -->
                    <div class="col-md-6 mb-4">
                        <div class="border-left-primary pl-3">
                            <h6 class="text-primary font-weight-bold">Nama Ayah</h6>
                            <p class="mb-0">{{ $keluargaBerencana->orangTua->nama_ayah }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="border-left-primary pl-3">
                            <h6 class="text-primary font-weight-bold">Nama Ibu</h6>
                            <p class="mb-0">{{ $keluargaBerencana->orangTua->nama_ibu }}</p>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="col-md-6 mb-4">
                        <div class="border-left-info pl-3">
                            <h6 class="text-info font-weight-bold">Kategori KB</h6>
                            <p class="mb-0">
                                {{ $keluargaBerencana->kategoriKeluargaBerencana->nama_kategori_keluarga_berencana }}</p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-md-6 mb-4">
                        <div class="border-left-warning pl-3">
                            <h6 class="text-warning font-weight-bold">Status</h6>
                            <span
                                class="badge badge-{{ $keluargaBerencana->is_active === 'Active' ? 'success' : 'danger' }} py-1 px-3">
                                {{ $keluargaBerencana->is_active }}
                            </span>
                        </div>
                    </div>

                    <!-- Permanen -->
                    <div class="col-md-6 mb-4">
                        <div class="border-left-dark pl-3">
                            <h6 class="text-dark font-weight-bold">Metode Permanen</h6>
                            <p class="mb-0">{{ $keluargaBerencana->is_permanent ? 'Ya' : 'Tidak' }}</p>
                        </div>
                    </div>

                    <!-- Tanggal -->
                    <div class="col-md-6 mb-4">
                        <div class="border-left-success pl-3">
                            <h6 class="text-success font-weight-bold">Tanggal Mulai</h6>
                            <p class="mb-0">
                                {{ \Carbon\Carbon::parse($keluargaBerencana->tanggal_mulai_keluarga_berencana)->format('d-m-Y') }}
                            </p>
                        </div>
                    </div>

                    @if (!$keluargaBerencana->is_permanent && $keluargaBerencana->tanggal_selesai_keluarga_berencana)
                        <div class="col-md-6 mb-4">
                            <div class="border-left-danger pl-3">
                                <h6 class="text-danger font-weight-bold">Tanggal Selesai</h6>
                                <p class="mb-0">
                                    {{ \Carbon\Carbon::parse($keluargaBerencana->tanggal_selesai_keluarga_berencana)->format('d-m-Y') }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Catatan -->
                    <div class="col-md-12 mb-4">
                        <h5 class="font-weight-bold text-info"><i class="fas fa-sticky-note mr-1"></i>Catatan</h5>
                        <div class="alert alert-info shadow-sm">
                            {{ $keluargaBerencana->catatan_keluarga_berencana ?? 'Tidak ada catatan.' }}
                        </div>
                    </div>
                </div>

                <!-- Action -->
                <div class="text-center mt-4">
                    <a href="{{ route('keluarga-berencana.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-4 py-2 mr-2">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                    <a href="{{ route('keluarga-berencana.edit', $keluargaBerencana->id) }}"
                        class="btn btn-primary rounded-pill px-4 py-2">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </a>
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

        .breadcrumb-item a {
            color: #6c757d;
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

        .border-left-primary {
            border-left: 4px solid #4e73df;
        }

        .border-left-success {
            border-left: 4px solid #1cc88a;
        }

        .border-left-info {
            border-left: 4px solid #36b9cc;
        }

        .border-left-warning {
            border-left: 4px solid #f6c23e;
        }

        .border-left-danger {
            border-left: 4px solid #e74a3b;
        }

        .border-left-dark {
            border-left: 4px solid #5a5c69;
        }
    </style>
@endpush
