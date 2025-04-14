@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Jadwal Kunjungan KB</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('keluarga-berencana.index') }}">
                            Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Jadwal Kunjungan</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST"
                    action="{{ route('keluarga-berencana.jadwal-kunjungan-kb.update', $jadwalKunjunganKB->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Jenis Kunjungan -->
                    <div class="form-group">
                        <label for="jenis_kunjungan_kb_id">Jenis Kunjungan</label>
                        <select name="jenis_kunjungan_kb_id" id="jenis_kunjungan_kb_id"
                            class="form-control @error('jenis_kunjungan_kb_id') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kunjungan --</option>
                            @foreach ($jenisKunjunganKeluargaBerencana as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ (old('jenis_kunjungan_kb_id') ?? $jadwalKunjunganKB->jenis_kunjungan_kb_id) == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_kunjungan_keluarga_berencana }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_kunjungan_kb_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="form-group">
                        <label for="tanggal_kunjungan_kb">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan_kb" id="tanggal_kunjungan_kb"
                            class="form-control @error('tanggal_kunjungan_kb') is-invalid @enderror"
                            value="{{ old('tanggal_kunjungan_kb') ?? $jadwalKunjunganKB->tanggal_kunjungan_kb }}">
                        @error('tanggal_kunjungan_kb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('keluarga-berencana.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Jadwal</button>
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

        .breadcrumb-item.active {
            font-weight: bold;
            color: #007bff;
        }
    </style>
@endpush
