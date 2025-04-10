@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Obat Kunjungan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.form-edit-obat-kunjungan', $kunjunganObat->id) }}"
                            class="{{ request()->routeIs('kunjungan.form-edit-obat-kunjungan') ? 'active' : '' }}">
                            Edit Obat Kunjungan
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Form Edit Obat Kunjungan -->
                <form method="POST" action="{{ route('kunjungan.update-obat-kunjungan', $kunjunganObat->id) }}">
                    @csrf
                    @method('PUT') <!-- Method spoofing for PUT -->

                    <!-- Obat (Radio Button untuk memilih obat) -->
                    <div class="form-group">
                        <label for="obat_id">Obat:</label>
                        <div>
                            @foreach ($obat as $item)
                                <div class="form-check">
                                    <!-- Radio Button untuk memilih hanya satu obat -->
                                    <input type="radio" name="obat_id" value="{{ $item->id }}"
                                        class="form-check-input @error('obat_id') is-invalid @enderror"
                                        {{ old('obat_id', $kunjunganObat->obat_id) == $item->id ? 'checked' : '' }}>
                                    <label class="form-check-label" for="obat_{{ $item->id }}">
                                        {{ $item->nama_obat_vitamin }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('obat_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Jumlah Obat -->
                    <div class="form-group">
                        <label for="jumlah_obat">Jumlah Obat:</label>
                        <input type="number" name="jumlah_obat" id="jumlah_obat" class="form-control"
                            value="{{ old('jumlah_obat', $kunjunganObat->jumlah_obat) }}" min="1">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kunjungan.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
