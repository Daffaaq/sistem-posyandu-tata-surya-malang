@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Edit Keluarga Berencana</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('keluarga-berencana.index') }}"
                            class="{{ request()->routeIs('keluarga-berencana.index') ? 'active' : '' }}">
                            Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('keluarga-berencana.update', $keluargaBerencana->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Orang Tua -->
                    <div class="form-group">
                        <label for="orang_tua_id">Orang Tua:</label>
                        <select name="orang_tua_id" id="orang_tua_id"
                            class="form-control @error('orang_tua_id') is-invalid @enderror">
                            <option value="">-- Pilih Orang Tua --</option>
                            @foreach ($orangTua as $item)
                                <option value="{{ $item->id }}"
                                    {{ (old('orang_tua_id') ?? $keluargaBerencana->orang_tua_id) == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_ayah }} & {{ $item->nama_ibu }}
                                </option>
                            @endforeach
                        </select>
                        @error('orang_tua_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kategori KB -->
                    <div class="form-group">
                        <label for="kategori_keluarga_berencana_id">Kategori Keluarga Berencana:</label>
                        <select name="kategori_keluarga_berencana_id" id="kategori_keluarga_berencana_id"
                            class="form-control @error('kategori_keluarga_berencana_id') is-invalid @enderror">
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoriKeluargaBerencana as $kategori)
                                <option value="{{ $kategori->id }}"
                                    {{ (old('kategori_keluarga_berencana_id') ?? $keluargaBerencana->kategori_keluarga_berencana_id) == $kategori->id ? 'selected' : '' }}>
                                    {{ $kategori->nama_kategori_keluarga_berencana }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori_keluarga_berencana_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Permanen -->
                    <div class="form-group">
                        <label for="is_permanent">Permanen Metode Keluarga Berencana</label>
                        <div class="form-check">
                            <input class="form-check-input @error('is_permanent') is-invalid @enderror" type="radio"
                                name="is_permanent" id="is_permanent_yes" value="1"
                                {{ (old('is_permanent') ?? $keluargaBerencana->is_permanent) == '1' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_permanent_yes">Ya, Permanen</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('is_permanent') is-invalid @enderror" type="radio"
                                name="is_permanent" id="is_permanent_no" value="0"
                                {{ (old('is_permanent') ?? $keluargaBerencana->is_permanent) == '0' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_permanent_no">Tidak Permanen</label>
                        </div>
                        @error('is_permanent')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div class="form-group">
                        <label for="tanggal_mulai_keluarga_berencana">Tanggal Mulai:</label>
                        <input type="date" name="tanggal_mulai_keluarga_berencana" id="tanggal_mulai_keluarga_berencana"
                            class="form-control @error('tanggal_mulai_keluarga_berencana') is-invalid @enderror"
                            value="{{ old('tanggal_mulai_keluarga_berencana') ?? $keluargaBerencana->tanggal_mulai_keluarga_berencana }}">
                        @error('tanggal_mulai_keluarga_berencana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="form-group" id="tanggal-selesai-group">
                        <label for="tanggal_selesai_keluarga_berencana">Tanggal Selesai:</label>
                        <input type="date" name="tanggal_selesai_keluarga_berencana"
                            id="tanggal_selesai_keluarga_berencana"
                            class="form-control @error('tanggal_selesai_keluarga_berencana') is-invalid @enderror"
                            value="{{ old('tanggal_selesai_keluarga_berencana') ?? $keluargaBerencana->tanggal_selesai_keluarga_berencana }}">
                        @error('tanggal_selesai_keluarga_berencana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div class="form-group">
                        <label for="catatan_keluarga_berencana">Catatan:</label>
                        <textarea name="catatan_keluarga_berencana" id="catatan_keluarga_berencana"
                            class="form-control @error('catatan_keluarga_berencana') is-invalid @enderror" placeholder="Tulis catatan...">{{ old('catatan_keluarga_berencana') ?? $keluargaBerencana->catatan_keluarga_berencana }}</textarea>
                        @error('catatan_keluarga_berencana')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="is_active">Status:</label>
                        <select name="is_active" id="is_active"
                            class="form-control @error('is_active') is-invalid @enderror">
                            <option value="">-- Pilih Status --</option>
                            <option value="Active"
                                {{ (old('is_active') ?? $keluargaBerencana->is_active) == 'Active' ? 'selected' : '' }}>
                                Active</option>
                            <option value="Non-Active"
                                {{ (old('is_active') ?? $keluargaBerencana->is_active) == 'Non-Active' ? 'selected' : '' }}>
                                Non-Active</option>
                        </select>
                        @error('is_active')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('keluarga-berencana.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radios = document.querySelectorAll('input[name="is_permanent"]');
            const tanggalSelesaiGroup = document.getElementById('tanggal-selesai-group');
            const tanggalSelesaiInput = document.getElementById('tanggal_selesai_keluarga_berencana');

            function toggleTanggalSelesai() {
                const selectedValue = document.querySelector('input[name="is_permanent"]:checked')?.value;

                if (selectedValue === '1') {
                    tanggalSelesaiGroup.style.display = 'none';
                    tanggalSelesaiInput.value = '';
                } else {
                    tanggalSelesaiGroup.style.display = 'block';
                }
            }

            radios.forEach(radio => {
                radio.addEventListener('change', toggleTanggalSelesai);
            });

            toggleTanggalSelesai();
        });
    </script>
@endpush
