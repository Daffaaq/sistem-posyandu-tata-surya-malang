@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Logo Login</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('logo-login.index') }}"
                            class="{{ request()->routeIs('logo-login.index') ? 'active' : '' }}">Logo Login</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('logo-login.create') }}"
                            class="{{ request()->routeIs('logo-login.create') ? 'active' : '' }}">Create Logo Login</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Logo Login Create Form -->
                <form method="POST" action="{{ route('logo-login.store') }}" enctype="multipart/form-data" id="logoForm">
                    @csrf

                    <!-- Judul Logo -->
                    <div class="form-group">
                        <label for="judul_logo_login">Judul Logo:</label>
                        <input type="text" name="judul_logo_login" id="judul_logo_login"
                            class="form-control @error('judul_logo_login') is-invalid @enderror"
                            value="{{ old('judul_logo_login') }}" placeholder="Masukkan judul logo login">
                        @error('judul_logo_login')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Upload Logo -->
                    <div class="form-group">
                        <label for="logo_login">Upload Logo:</label>
                        <input type="file" name="logo_login" id="logo_login"
                            class="form-control-file @error('logo_login') is-invalid @enderror" accept="image/*">
                        @error('logo_login')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <!-- Preview Gambar -->
                        <div class="mt-3">
                            <img id="logo_preview" src="#" alt="Preview Logo"
                                style="max-height: 100px; display: none;">
                        </div>
                    </div>


                    <!-- Status -->
                    <div class="form-group">
                        <label for="status_logo_login">Status:</label>
                        <div class="form-check">
                            <input class="form-check-input @error('status_logo_login') is-invalid @enderror" type="radio"
                                name="status_logo_login" id="status_active" value="active"
                                {{ old('status_logo_login') == 'active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_active">
                                Aktif
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input @error('status_logo_login') is-invalid @enderror" type="radio"
                                name="status_logo_login" id="status_non_active" value="non-active"
                                {{ old('status_logo_login') == 'non-active' ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_non_active">
                                Non-Aktif
                            </label>
                        </div>
                        @error('status_logo_login')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('logo-login.index') }}">Cancel</a>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Preview gambar sebelum upload
        $('#logo_login').change(function() {
            const input = this;

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    $('#logo_preview').attr('src', e.target.result).show();
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                $('#logo_preview').hide();
            }
        });

        $(document).ready(function() {
            $('#logoForm').on('submit', function(e) {
                const status = $('input[name="status_logo_login"]:checked').val();

                // Kalau tidak memilih status, jangan submit
                if (!status) {
                    return;
                }

                // Kalau status 'active', cek dulu ke server
                if (status === 'active') {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('logo-login.check-active') }}",
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            if (data.exists) {
                                Swal.fire({
                                    title: 'Perhatian!',
                                    text: 'Sudah ada logo yang aktif. Logo ini akan disimpan sebagai non-active. Lanjutkan?',
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonText: 'Lanjutkan',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#status_non_active').prop('checked', true);
                                        $('#logoForm')[0].submit();
                                    }
                                });
                            } else {
                                $('#logoForm')[0].submit();
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops!',
                                text: 'Gagal memeriksa status aktif. Silakan coba lagi.'
                            });
                        }
                    });
                } else {
                    // Kalau status bukan 'active' → submit langsung
                    return true;
                }
            });
        });
    </script>
@endpush
