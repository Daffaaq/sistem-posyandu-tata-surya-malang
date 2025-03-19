@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Jenis Kunjungan Keluarga Berencana</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('jenis-kunjungan-kb.index') }}"
                            class="{{ request()->routeIs('jenis-kunjungan-kb.index') ? 'active' : '' }}">
                            Jenis Kunjungan Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('jenis-kunjungan-kb.edit', $jenisKunjunganKeluargaBerencana->id) }}"
                            class="{{ request()->routeIs('jenis-kunjungan-kb.edit') ? 'active' : '' }}">
                            Edit Jenis Kunjungan Keluarga Berencana
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Jenis Kunjungan Keluarga Berencana Edit Form -->
                <form method="POST"
                    action="{{ route('jenis-kunjungan-kb.update', $jenisKunjunganKeluargaBerencana->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Jenis Kunjungan Keluarga Berencana -->
                    <div class="form-group">
                        <label for="nama_jenis_kunjungan_keluarga_berencana">Nama Jenis Kunjungan Keluarga
                            Berencana:</label>
                        <input type="text" name="nama_jenis_kunjungan_keluarga_berencana"
                            id="nama_jenis_kunjungan_keluarga_berencana"
                            placeholder="Nama Jenis Kunjungan Keluarga Berencana"
                            class="form-control @error('nama_jenis_kunjungan_keluarga_berencana') is-invalid @enderror"
                            value="{{ old('nama_jenis_kunjungan_keluarga_berencana', $jenisKunjunganKeluargaBerencana->nama_jenis_kunjungan_keluarga_berencana) }}">
                        @error('nama_jenis_kunjungan_keluarga_berencana')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Tulis deskripsi disini...">{{ old('deskripsi', $jenisKunjunganKeluargaBerencana->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('jenis-kunjungan-kb.index') }}">Cancel</a>
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
