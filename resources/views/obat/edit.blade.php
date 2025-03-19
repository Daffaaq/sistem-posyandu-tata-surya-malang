@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Obat</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('obat.index') }}"
                            class="{{ request()->routeIs('obat.index') ? 'active' : '' }}">Obat</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('obat.edit', $obat->id) }}"
                            class="{{ request()->routeIs('obat.edit') ? 'active' : '' }}">Edit Obat</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Obat Edit Form -->
                <form method="POST" action="{{ route('obat.update', $obat->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Nama Obat Vitamin -->
                    <div class="form-group">
                        <label for="nama_obat_vitamin">Nama Obat Vitamin:</label>
                        <input type="text" name="nama_obat_vitamin" id="nama_obat_vitamin"
                            placeholder="Nama Obat Vitamin"
                            class="form-control @error('nama_obat_vitamin') is-invalid @enderror"
                            value="{{ old('nama_obat_vitamin', $obat->nama_obat_vitamin) }}">
                        @error('nama_obat_vitamin')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi:</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                            placeholder="Tulis deskripsi disini...">{{ old('deskripsi', $obat->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div class="form-group">
                        <label for="tipe">Tipe:</label>
                        <div class="form-check">
                            <input class="form-check-input @error('tipe') is-invalid @enderror" type="radio"
                                name="tipe" id="tipe_obat" value="obat"
                                {{ old('tipe', $obat->tipe) == 'obat' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_obat">
                                Obat
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('tipe') is-invalid @enderror" type="radio"
                                name="tipe" id="tipe_vitamin" value="vitamin"
                                {{ old('tipe', $obat->tipe) == 'vitamin' ? 'checked' : '' }}>
                            <label class="form-check-label" for="tipe_vitamin">
                                Vitamin
                            </label>
                        </div>
                        @error('tipe')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Stok -->
                    <div class="form-group">
                        <label for="stok">Stok:</label>
                        <input type="number" name="stok" id="stok" placeholder="Jumlah Stok"
                            class="form-control @error('stok') is-invalid @enderror"
                            value="{{ old('stok', $obat->stok) }}">
                        @error('stok')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Tanggal Kadaluarsa -->
                    <div class="form-group">
                        <label for="tanggal_kadaluarsa">Tanggal Kadaluarsa:</label>
                        <input type="date" name="tanggal_kadaluarsa" id="tanggal_kadaluarsa"
                            class="form-control @error('tanggal_kadaluarsa') is-invalid @enderror"
                            value="{{ old('tanggal_kadaluarsa', $obat->tanggal_kadaluarsa) }}">
                        @error('tanggal_kadaluarsa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('obat.index') }}">Cancel</a>
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
