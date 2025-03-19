@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tipe Kunjungan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('tipe-kunjungan.index') }}"
                            class="{{ request()->routeIs('tipe-kunjungan.index') ? 'active' : '' }}">Tipe Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('tipe-kunjungan.create') }}"
                            class="{{ request()->routeIs('tipe-kunjungan.create') ? 'active' : '' }}">Create Tipe
                            Kunjungan</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Tipe Kunjungan Create Form -->
                <form method="POST" action="{{ route('tipe-kunjungan.store') }}">
                    @csrf
                    <!-- Nama Tipe Kunjungan -->
                    <div class="form-group">
                        <label for="nama_tipe_kunjungan">Nama Tipe Kunjungan:</label>
                        <input type="text" name="nama_tipe_kunjungan" id="nama_tipe_kunjungan"
                            placeholder="Nama Tipe Kunjungan"
                            class="form-control @error('nama_tipe_kunjungan') is-invalid @enderror"
                            value="{{ old('nama_tipe_kunjungan') }}">
                        @error('nama_tipe_kunjungan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Tulis deskripsi disini...">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('tipe-kunjungan.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
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
