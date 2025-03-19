@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Posyandu</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('jadwal-posyandu.index') }}"
                            class="{{ request()->routeIs('jadwal-posyandu.index') ? 'active' : '' }}">Jadwal Posyandu</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('jadwal-posyandu.create') }}"
                            class="{{ request()->routeIs('jadwal-posyandu.create') ? 'active' : '' }}">Create Jadwal
                            Posyandu</a>
                    </li>
                </ol>
            </div>
            @if (session('error'))
                <div class="alert alert-light-danger alert-dismissible fade show" style="height: 50px" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card-body">
                <!-- Jadwal Posyandu Create Form -->
                <form method="POST" action="{{ route('jadwal-posyandu.store') }}">
                    @csrf
                    <!-- Nama Kegiatan -->
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan:</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" placeholder="Nama Kegiatan"
                            class="form-control @error('nama_kegiatan') is-invalid @enderror"
                            value="{{ old('nama_kegiatan') }}">
                        @error('nama_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Kegiatan -->
                    <div class="form-group">
                        <label for="tanggal_kegiatan">Tanggal Kegiatan:</label>
                        <input type="date" name="tanggal_kegiatan" id="tanggal_kegiatan"
                            class="form-control @error('tanggal_kegiatan') is-invalid @enderror"
                            value="{{ old('tanggal_kegiatan') }}">
                        @error('tanggal_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Waktu Kegiatan -->
                    <div class="form-group">
                        <label for="waktu_kegiatan">Waktu Kegiatan:</label>
                        <input type="time" name="waktu_kegiatan" id="waktu_kegiatan"
                            class="form-control @error('waktu_kegiatan') is-invalid @enderror"
                            value="{{ old('waktu_kegiatan') }}">
                        @error('waktu_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tempat Kegiatan -->
                    <div class="form-group">
                        <label for="tempat_kegiatan">Tempat Kegiatan:</label>
                        <input type="text" name="tempat_kegiatan" id="tempat_kegiatan" placeholder="Tempat Kegiatan"
                            class="form-control @error('tempat_kegiatan') is-invalid @enderror"
                            value="{{ old('tempat_kegiatan') }}">
                        @error('tempat_kegiatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('jadwal-posyandu.index') }}">Cancel</a>
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
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Failed!',
                    text: '{{ session('error') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif
        });
    </script>
@endpush
