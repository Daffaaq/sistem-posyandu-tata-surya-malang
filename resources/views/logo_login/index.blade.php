@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Logo Login</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('logo-login.index') }}"
                            class="{{ request()->routeIs('logo-login.index') ? 'active' : '' }}">Logo Login</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="d-flex justify-content-between mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="filter-active">
                        <label class="form-check-label" for="filter-active">
                            Tampilkan hanya yang aktif
                        </label>
                    </div>
                    <div>
                        <a href="{{ route('logo-login.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Logo
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="LogoLoginTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul Logo</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will fill this -->
                        </tbody>
                    </table>
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
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            var dataTable = $('#LogoLoginTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('logo-login.list') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: function(d) {
                        d.active_only = $('#filter-active').is(':checked') ? 1 : 0;
                        d._token = '{{ csrf_token() }}';
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'judul_logo_login',
                        name: 'judul_logo_login'
                    },
                    {
                        data: 'status_logo_login',
                        name: 'status_logo_login'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let editUrl = `/master-management/logo-login/${data}/edit`;
                            let showUrl = `/master-management/logo-login/${data}`;
                            return `
                                <a href="${showUrl}" class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="${editUrl}" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete('${data}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;
                        }
                    }
                ]
            });

            // Checkbox filter
            $('#filter-active').on('change', function() {
                dataTable.ajax.reload();
            });

            // Success Toast
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/master-management/logo-login/${id}`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire('Dihapus!', response.message, 'success');
                                $('#LogoLoginTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire('Gagal!', response.message || 'Terjadi kesalahan.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Gagal!', 'Tidak dapat menghubungi server.', 'error');
                        }
                    });
                }
            });
        }
    </script>
@endpush
