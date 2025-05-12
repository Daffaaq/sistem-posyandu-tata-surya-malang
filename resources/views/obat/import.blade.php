@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Impor Data Obat</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('obat.index') }}" class="{{ request()->routeIs('obat.index') ? 'active' : '' }}">Obat</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('obat.import') }}" class="{{ request()->routeIs('obat.import') ? 'active' : '' }}">Impor Obat</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Form Impor Excel -->
                <form action="{{ route('obat.import') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- File Upload -->
                    <div class="form-group">
                        <label for="file">Pilih File Excel:</label>
                        <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror" required>
                        @error('file')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('obat.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Impor</button>
                        </div>
                    </div>
                </form>

                <!-- Pesan sukses atau error setelah impor -->
                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        {{ session('error') }}
                    </div>
                @endif
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
