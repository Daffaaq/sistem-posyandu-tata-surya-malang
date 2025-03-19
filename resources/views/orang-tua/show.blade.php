@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Detail Orang Tua</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.index') }}"
                            class="{{ request()->routeIs('orang-tua.index') ? 'active' : '' }}">Orang Tua</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Nama Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Nama Ayah</h5>
                        <p>{{ $orangTua->nama_ayah }}</p>
                    </div>

                    <!-- Nama Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Nama Ibu</h5>
                        <p>{{ $orangTua->nama_ibu }}</p>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Jenis Kelamin Ayah</h5>
                        <p>{{ $orangTua->jenis_kelamin_ayah }}</p>
                    </div>

                    <!-- Jenis Kelamin Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Jenis Kelamin Ibu</h5>
                        <p>{{ $orangTua->jenis_kelamin_ibu }}</p>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Tanggal Lahir Ayah</h5>
                        <p>{{ \Carbon\Carbon::parse($orangTua->tanggal_lahir_ayah)->format('d-m-Y') }}</p>
                    </div>

                    <!-- Tanggal Lahir Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Tanggal Lahir Ibu</h5>
                        <p>{{ \Carbon\Carbon::parse($orangTua->tanggal_lahir_ibu)->format('d-m-Y') }}</p>
                    </div>

                    <!-- No Telepon Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">No Telepon Ayah</h5>
                        <p>{{ $orangTua->no_telepon_ayah }}</p>
                    </div>

                    <!-- No Telepon Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">No Telepon Ibu</h5>
                        <p>{{ $orangTua->no_telepon_ibu }}</p>
                    </div>

                    <!-- Email Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Email Ayah</h5>
                        <p>{{ $orangTua->email_ayah }}</p>
                    </div>

                    <!-- Email Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Email Ibu</h5>
                        <p>{{ $orangTua->email_ibu }}</p>
                    </div>

                    <!-- Pekerjaan Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Pekerjaan Ayah</h5>
                        <p>{{ $orangTua->pekerjaan_ayah }}</p>
                    </div>

                    <!-- Pekerjaan Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Pekerjaan Ibu</h5>
                        <p>{{ $orangTua->pekerjaan_ibu }}</p>
                    </div>

                    <!-- Agama Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Agama Ayah</h5>
                        <p>{{ $orangTua->agama_ayah }}</p>
                    </div>

                    <!-- Agama Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Agama Ibu</h5>
                        <p>{{ $orangTua->agama_ibu }}</p>
                    </div>

                    <!-- Alamat Ayah -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Alamat Ayah</h5>
                        <p>{{ $orangTua->alamat_ayah }}</p>
                    </div>

                    <!-- Alamat Ibu -->
                    <div class="col-md-6 mb-3">
                        <h5 class="font-weight-bold">Alamat Ibu</h5>
                        <p>{{ $orangTua->alamat_ibu }}</p>
                    </div>
                </div>

                <hr>

                <!-- User Status -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h5 class="font-weight-bold">Status Akun</h5>
                        <div class="d-flex align-items-center">
                            <span
                                class="badge 
        {{ $orangTua->user->is_active == 'active' ? 'badge-success' : 'badge-danger' }} 
        p-2 rounded-pill text-uppercase font-weight-bold"
                                data-toggle="tooltip"
                                title="{{ $orangTua->user->is_active == 'active' ? 'Account Active' : 'Account Non-Active' }}">
                                <i
                                    class="fas 
            {{ $orangTua->user->is_active == 'active' ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="btn-group" role="group" aria-label="User Action">
                            @if ($orangTua->user->is_active == 'non-active')
                                @can('orang-tua.accepted')
                                    <button class="btn btn-lg btn-success rounded-pill px-4 py-2" id="acceptBtn"
                                        data-toggle="tooltip" data-placement="top" title="Terima akun orang tua">
                                        <i class="fas fa-check-circle"></i>
                                    </button>
                                @endcan
                            @else
                                @can('orang-tua.rejected')
                                    <button class="btn btn-lg btn-danger rounded-pill px-4 py-2" id="rejectBtn"
                                        data-toggle="tooltip" data-placement="top" title="Tolak akun orang tua">
                                        <i class="fas fa-times-circle"></i>
                                    </button>
                                @endcan
                            @endif
                        </div>
                    </div>
                </div>

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

        /* Custom Styling for Labels and Buttons */
        .card-body h5 {
            font-size: 1.1rem;
            color: #555;
        }

        .card-body p {
            font-size: 1rem;
            color: #333;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
        // Accept Button Click
        $('#acceptBtn').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menerima account orang tua ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Terima!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('orang-tua.accepted', $orangTua->id) }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload(); // Reload page after success
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menerima orang tua.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    });
                }
            });
        });

        // Reject Button Click
        $('#rejectBtn').on('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menolak account orang tua ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Tolak!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('orang-tua.rejected', $orangTua->id) }}',
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            }).then(function() {
                                location.reload(); // Reload page after success
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menolak orang tua.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                            });
                        }
                    });
                }
            });
        });
    </script>
@endpush
