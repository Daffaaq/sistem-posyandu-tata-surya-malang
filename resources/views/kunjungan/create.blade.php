@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Kunjungan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.create') }}"
                            class="{{ request()->routeIs('kunjungan.create') ? 'active' : '' }}">Tambah Kunjungan</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Kunjungan Create Form -->
                <form method="POST" action="{{ route('kunjungan.store') }}">
                    @csrf
                    <!-- Tanggal Kunjungan -->
                    <div class="form-group">
                        <label for="tanggal_kunjungan">Tanggal Kunjungan:</label>
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan"
                            class="form-control @error('tanggal_kunjungan') is-invalid @enderror"
                            value="{{ old('tanggal_kunjungan') }}">
                        @error('tanggal_kunjungan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi Kunjungan -->
                    <div class="form-group">
                        <label for="deskripsi_kunjungan">Deskripsi Kunjungan:</label>
                        <textarea name="deskripsi_kunjungan" id="deskripsi_kunjungan"
                            class="form-control @error('deskripsi_kunjungan') is-invalid @enderror" placeholder="Tulis deskripsi kunjungan...">{{ old('deskripsi_kunjungan') }}</textarea>
                        @error('deskripsi_kunjungan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tipe Kunjungan -->
                    <div class="form-group">
                        <label for="tipe_kunjungan_id">Tipe Kunjungan:</label>
                        <select name="tipe_kunjungan_id" id="tipe_kunjungan_id"
                            class="form-control select2 @error('tipe_kunjungan_id') is-invalid @enderror">
                            <option value="">Pilih Tipe Kunjungan</option>
                            @foreach ($dataTipeKunjungan as $tipe)
                                <option value="{{ $tipe->id }}"
                                    {{ old('tipe_kunjungan_id') == $tipe->id ? 'selected' : '' }}>
                                    {{ $tipe->nama_tipe_kunjungan }}
                                </option>
                            @endforeach
                        </select>
                        @error('tipe_kunjungan_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Orang Tua -->
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua:</label>
                        <select name="orang_tua_id" id="orang_tua_id"
                            class="form-control select2 @error('orang_tua_id') is-invalid @enderror">
                            <option value="">Pilih Orang Tua</option>
                            @foreach ($dataOrangTua as $orangTua)
                                <option value="{{ $orangTua->id }}"
                                    {{ old('orang_tua_id') == $orangTua->id ? 'selected' : '' }}>
                                    {{ $orangTua->nama_ayah }} / {{ $orangTua->nama_ibu }}
                                </option>
                            @endforeach
                        </select>
                        @error('orang_tua_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kunjungan.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for search functionality
            $('.select2').select2();

            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
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
