@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Kategori Imunisasi</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kategori-imunisasi.index') }}"
                            class="{{ request()->routeIs('kategori-imunisasi.index') ? 'active' : '' }}">
                            Kategori Imunisasi
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kategori-imunisasi.edit', $kategoriImunasasi->id) }}"
                            class="{{ request()->routeIs('kategori-imunisasi.edit') ? 'active' : '' }}">
                            Edit Kategori Imunisasi
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Edit Kategori Imunisasi Form -->
                <form method="POST" action="{{ route('kategori-imunisasi.update', $kategoriImunasasi->id) }}">
                    @csrf
                    @method('PUT') <!-- This is to indicate a PUT request for updating the resource -->

                    <!-- Nama Kategori Imunisasi -->
                    <div class="form-group">
                        <label for="nama_kategori_imunisasi">Nama Kategori Imunisasi:</label>
                        <input type="text" name="nama_kategori_imunisasi" id="nama_kategori_imunisasi"
                            placeholder="Nama Kategori Imunisasi"
                            class="form-control @error('nama_kategori_imunisasi') is-invalid @enderror"
                            value="{{ old('nama_kategori_imunisasi', $kategoriImunasasi->nama_kategori_imunisasi) }}">
                        @error('nama_kategori_imunisasi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Keterangan -->
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                            placeholder="Tulis keterangan disini...">{{ old('keterangan', $kategoriImunasasi->keterangan) }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Status Aktif -->
                    <div class="form-group">
                        <label for="is_active">Status Aktif:</label>
                        <select class="form-control @error('is_active') is-invalid @enderror" id="is_active"
                            name="is_active">
                            <option value="1"
                                {{ old('is_active', $kategoriImunasasi->is_active) == '1' ? 'selected' : '' }}>Aktif
                            </option>
                            <option value="0"
                                {{ old('is_active', $kategoriImunasasi->is_active) == '0' ? 'selected' : '' }}>Non-Aktif
                            </option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kategori-imunisasi.index') }}">Cancel</a>
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
