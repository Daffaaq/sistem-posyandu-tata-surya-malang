<!-- Orang Tua Information -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h6 class="m-0 font-weight-bold text-primary">Orang Tua Information</h6>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Ayah -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_ayah">Nama Ayah:</label>
                    <input type="text" name="nama_ayah" id="nama_ayah"
                        class="form-control @error('nama_ayah') is-invalid @enderror"
                        value="{{ old('nama_ayah', $orangTua->nama_ayah ?? '') }}">
                    @error('nama_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah:</label>
                    <input type="date" name="tanggal_lahir_ayah" id="tanggal_lahir_ayah"
                        class="form-control @error('tanggal_lahir_ayah') is-invalid @enderror"
                        value="{{ old('tanggal_lahir_ayah', $orangTua->tanggal_lahir_ayah ?? '') }}">
                    @error('tanggal_lahir_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_telepon_ayah">No Telepon Ayah:</label>
                    <input type="text" name="no_telepon_ayah" id="no_telepon_ayah"
                        class="form-control @error('no_telepon_ayah') is-invalid @enderror"
                        value="{{ old('no_telepon_ayah', $orangTua->no_telepon_ayah ?? '') }}">
                    @error('no_telepon_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email_ayah">Email Ayah:</label>
                    <input type="email" name="email_ayah" id="email_ayah"
                        class="form-control @error('email_ayah') is-invalid @enderror"
                        value="{{ old('email_ayah', $orangTua->email_ayah ?? '') }}">
                    @error('email_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ayah">Pekerjaan Ayah:</label>
                    <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah"
                        class="form-control @error('pekerjaan_ayah') is-invalid @enderror"
                        value="{{ old('pekerjaan_ayah', $orangTua->pekerjaan_ayah ?? '') }}">
                    @error('pekerjaan_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="agama_ayah">Agama Ayah:</label>
                    <select name="agama_ayah" id="agama_ayah"
                        class="form-control @error('agama_ayah') is-invalid @enderror">
                        <option value="">-- Pilih Agama --</option>
                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}"
                                {{ old('agama_ayah', $orangTua->agama_ayah ?? '') == $agama ? 'selected' : '' }}>
                                {{ $agama }}
                            </option>
                        @endforeach
                    </select>
                    @error('agama_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat_ayah">Alamat Ayah:</label>
                    <textarea name="alamat_ayah" id="alamat_ayah"
                        class="form-control @error('alamat_ayah') is-invalid @enderror">{{ old('alamat_ayah', $orangTua->alamat_ayah ?? '') }}</textarea>
                    @error('alamat_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Ibu -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_ibu">Nama Ibu:</label>
                    <input type="text" name="nama_ibu" id="nama_ibu"
                        class="form-control @error('nama_ibu') is-invalid @enderror"
                        value="{{ old('nama_ibu', $orangTua->nama_ibu ?? '') }}">
                    @error('nama_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu:</label>
                    <input type="date" name="tanggal_lahir_ibu" id="tanggal_lahir_ibu"
                        class="form-control @error('tanggal_lahir_ibu') is-invalid @enderror"
                        value="{{ old('tanggal_lahir_ibu', $orangTua->tanggal_lahir_ibu ?? '') }}">
                    @error('tanggal_lahir_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_telepon_ibu">No Telepon Ibu:</label>
                    <input type="text" name="no_telepon_ibu" id="no_telepon_ibu"
                        class="form-control @error('no_telepon_ibu') is-invalid @enderror"
                        value="{{ old('no_telepon_ibu', $orangTua->no_telepon_ibu ?? '') }}">
                    @error('no_telepon_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email_ibu">Email Ibu:</label>
                    <input type="email" name="email_ibu" id="email_ibu"
                        class="form-control @error('email_ibu') is-invalid @enderror"
                        value="{{ old('email_ibu', $orangTua->email_ibu ?? '') }}">
                    @error('email_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pekerjaan_ibu">Pekerjaan Ibu:</label>
                    <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu"
                        class="form-control @error('pekerjaan_ibu') is-invalid @enderror"
                        value="{{ old('pekerjaan_ibu', $orangTua->pekerjaan_ibu ?? '') }}">
                    @error('pekerjaan_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="agama_ibu">Agama Ibu:</label>
                    <select name="agama_ibu" id="agama_ibu"
                        class="form-control @error('agama_ibu') is-invalid @enderror">
                        <option value="">-- Pilih Agama --</option>
                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $agama)
                            <option value="{{ $agama }}"
                                {{ old('agama_ibu', $orangTua->agama_ibu ?? '') == $agama ? 'selected' : '' }}>
                                {{ $agama }}
                            </option>
                        @endforeach
                    </select>
                    @error('agama_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="alamat_ibu">Alamat Ibu:</label>
                    <textarea name="alamat_ibu" id="alamat_ibu"
                        class="form-control @error('alamat_ibu') is-invalid @enderror">{{ old('alamat_ibu', $orangTua->alamat_ibu ?? '') }}</textarea>
                    @error('alamat_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
