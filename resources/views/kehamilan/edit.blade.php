@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Data Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kehamilan.index') }}" class="{{ request()->routeIs('kehamilan.index') ? 'active' : '' }}">
                            Data Kehamilan
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('kehamilan.update', $kehamilan->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Orang Tua --}}
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua <span class="text-danger">*</span></label>
                        <select name="orang_tua_id" id="orang_tua_id" class="form-control @error('orang_tua_id') is-invalid @enderror">
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach ($orangTuaList as $parent)
                                <option value="{{ $parent->id }}" {{ old('orang_tua_id', $kehamilan->orang_tua_id) == $parent->id ? 'selected' : '' }}>
                                    {{ $parent->nama_ayah }} & {{ $parent->nama_ibu }}
                                </option>
                            @endforeach
                        </select>
                        @error('orang_tua_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tanggal Mulai Kehamilan --}}
                    <div class="form-group">
                        <label for="tanggal_mulai_kehamilan">Tanggal Mulai Kehamilan <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_mulai_kehamilan" class="form-control @error('tanggal_mulai_kehamilan') is-invalid @enderror" value="{{ old('tanggal_mulai_kehamilan', $kehamilan->tanggal_mulai_kehamilan) }}">
                        @error('tanggal_mulai_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Prediksi Tanggal Lahir --}}
                    <div class="form-group">
                        <label for="prediksi_tanggal_lahir">Prediksi Tanggal Lahir <span class="text-danger">*</span></label>
                        <input type="date" name="prediksi_tanggal_lahir" class="form-control @error('prediksi_tanggal_lahir') is-invalid @enderror" value="{{ old('prediksi_tanggal_lahir', $kehamilan->prediksi_tanggal_lahir) }}">
                        @error('prediksi_tanggal_lahir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Kehamilan --}}
                    <div class="form-group">
                        <label for="status_kehamilan">Status Kehamilan <span class="text-danger">*</span></label>
                        <select name="status_kehamilan" class="form-control @error('status_kehamilan') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="Hamil" {{ old('status_kehamilan', $kehamilan->status_kehamilan) == 'Hamil' ? 'selected' : '' }}>Hamil</option>
                            <option value="Melahirkan" {{ old('status_kehamilan', $kehamilan->status_kehamilan) == 'Melahirkan' ? 'selected' : '' }}>Melahirkan</option>
                            <option value="Gugur" {{ old('status_kehamilan', $kehamilan->status_kehamilan) == 'Gugur' ? 'selected' : '' }}>Gugur</option>
                        </select>
                        @error('status_kehamilan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>

                    {{-- Pemeriksaan Kehamilan --}}
                    <div id="pemeriksaan-container">
                        @foreach($kehamilan->pemeriksaanKehamilans as $index => $pemeriksaan)
                            <div class="pemeriksaan-item mb-4" data-index="{{ $index }}">

                                <input type="hidden" name="pemeriksaan_id[{{ $index }}]" value="{{ $pemeriksaan->id }}">
                                
                                <div class="form-group">
                                    <label for="tanggal_pemeriksaan_kehamilan_{{ $index }}">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                                    <input type="date" name="tanggal_pemeriksaan_kehamilan[{{ $index }}]" class="form-control @error('tanggal_pemeriksaan_kehamilan.' . $index) is-invalid @enderror" value="{{ old('tanggal_pemeriksaan_kehamilan.' . $index, $pemeriksaan->tanggal_pemeriksaan_kehamilan) }}">
                                    @error('tanggal_pemeriksaan_kehamilan.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi_pemeriksaan_kehamilan_{{ $index }}">Deskripsi Pemeriksaan <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi_pemeriksaan_kehamilan[{{ $index }}]" class="form-control @error('deskripsi_pemeriksaan_kehamilan.' . $index) is-invalid @enderror">{{ old('deskripsi_pemeriksaan_kehamilan.' . $index, $pemeriksaan->deskripsi_pemeriksaan_kehamilan) }}</textarea>
                                    @error('deskripsi_pemeriksaan_kehamilan.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="keluhan_kehamilan_{{ $index }}">Keluhan</label>
                                    <textarea name="keluhan_kehamilan[{{ $index }}]" class="form-control @error('keluhan_kehamilan.' . $index) is-invalid @enderror">{{ old('keluhan_kehamilan.' . $index, $pemeriksaan->keluhan_kehamilan) }}</textarea>
                                    @error('keluhan_kehamilan.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tekanan_darah_ibu_hamil_{{ $index }}">Tekanan Darah <span class="text-danger">*</span></label>
                                    <input type="text" name="tekanan_darah_ibu_hamil[{{ $index }}]" class="form-control @error('tekanan_darah_ibu_hamil.' . $index) is-invalid @enderror" value="{{ old('tekanan_darah_ibu_hamil.' . $index, $pemeriksaan->tekanan_darah_ibu_hamil) }}">
                                    @error('tekanan_darah_ibu_hamil.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="berat_badan_ibu_hamil_{{ $index }}">Berat Badan (kg) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" name="berat_badan_ibu_hamil[{{ $index }}]" class="form-control @error('berat_badan_ibu_hamil.' . $index) is-invalid @enderror" value="{{ old('berat_badan_ibu_hamil.' . $index, $pemeriksaan->berat_badan_ibu_hamil) }}">
                                    @error('berat_badan_ibu_hamil.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="posisi_janin_{{ $index }}">Posisi Janin <span class="text-danger">*</span></label>
                                    <input type="text" name="posisi_janin[{{ $index }}]" class="form-control @error('posisi_janin.' . $index) is-invalid @enderror" value="{{ old('posisi_janin.' . $index, $pemeriksaan->posisi_janin) }}">
                                    @error('posisi_janin.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="usia_kandungan_{{ $index }}">Usia Kandungan (minggu) <span class="text-danger">*</span></label>
                                    <input type="number" name="usia_kandungan[{{ $index }}]" class="form-control @error('usia_kandungan.' . $index) is-invalid @enderror" value="{{ old('usia_kandungan.' . $index, $pemeriksaan->usia_kandungan) }}">
                                    @error('usia_kandungan.' . $index)
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>
                            </div>
                        @endforeach
                    </div>

                    {{-- Buttons --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kehamilan.index') }}">Batal</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
