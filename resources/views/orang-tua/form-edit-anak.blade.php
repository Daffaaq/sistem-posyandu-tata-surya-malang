@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.view-form-add-children', $orangTua->id) }}"
                            class="{{ request()->routeIs('orang-tua.view-form-add-children', $orangTua->id) ? 'active' : '' }}">Anak</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.view-form-edit-anak', $anak->id) }}"
                            class="{{ request()->routeIs('orang-tua.view-form-edit-anak', $anak->id) ? 'active' : '' }}">Edit
                            Anak</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Edit Anak Form -->
                <form method="POST" action="{{ route('orang-tua.edit-anak', $anak->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Anak -->
                    <div class="form-group">
                        <label for="nama_anak">Nama Anak:</label>
                        <input type="text" name="nama_anak" id="nama_anak" placeholder="Nama Anak"
                            class="form-control @error('nama_anak') is-invalid @enderror"
                            value="{{ old('nama_anak', $anak->nama_anak) }}">
                        @error('nama_anak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin Anak -->
                    <div class="form-group">
                        <label for="jenis_kelamin_anak">Jenis Kelamin Anak:</label>
                        <select name="jenis_kelamin_anak" id="jenis_kelamin_anak"
                            class="form-control @error('jenis_kelamin_anak') is-invalid @enderror">
                            <option value="Laki-laki"
                                {{ old('jenis_kelamin_anak', $anak->jenis_kelamin_anak) == 'Laki-laki' ? 'selected' : '' }}>
                                Laki-laki</option>
                            <option value="Perempuan"
                                {{ old('jenis_kelamin_anak', $anak->jenis_kelamin_anak) == 'Perempuan' ? 'selected' : '' }}>
                                Perempuan</option>
                        </select>
                        @error('jenis_kelamin_anak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Lahir Anak -->
                    <div class="form-group">
                        <label for="tanggal_lahir_anak">Tanggal Lahir Anak:</label>
                        <input type="date" name="tanggal_lahir_anak" id="tanggal_lahir_anak"
                            class="form-control @error('tanggal_lahir_anak') is-invalid @enderror"
                            value="{{ old('tanggal_lahir_anak', $anak->tanggal_lahir_anak) }}">
                        @error('tanggal_lahir_anak')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary"
                                href="{{ route('orang-tua.view-form-add-children', $orangTua->id) }}">Cancel</a>
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
