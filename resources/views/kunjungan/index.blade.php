@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kunjungan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-end mb-3">
                    <!-- Tanggal di kiri -->
                    <div style="max-width: 250px;">
                        <label for="filterTanggal" class="form-label mb-1">Filter Tanggal Kunjungan:</label>
                        <input type="date" id="filterTanggal" class="form-control">
                    </div>

                    <!-- Tombol tambah di kanan -->
                    <a href="{{ route('kunjungan.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i> Tambah Kunjungan
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="KunjunganTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Tipe Kunjungan</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Action1</th>
                                <th>Action2</th>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var dataMaster = $('#KunjunganTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kunjungan.list') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.tanggal_kunjungan = $('#filterTanggal').val(); // ambil nilai filter
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_ayah',
                        name: 'nama_ayah'
                    },
                    {
                        data: 'nama_ibu',
                        name: 'nama_ibu'
                    },
                    {
                        data: 'nama_tipe_kunjungan',
                        name: 'nama_tipe_kunjungan'
                    },
                    {
                        width: '15%',
                        data: 'tanggal_kunjungan',
                        name: 'tanggal_kunjungan'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let plusPantauan =
                                `/posyandu-management/kunjungan/${data}/pantauan-tumbuh-kembang-anak`;
                            let plusPantauanOrangTua =
                                `/posyandu-management/kunjungan/${data}/pantauan-orang-tua`;
                            let imunisasi =
                                `/posyandu-management/kunjungan/${data}/imunisasi-anak`;

                            return `
                                <a href="${plusPantauan}" class="btn icon btn-sm btn-success" title="Pantauan Tumbuh Kembang Anak">
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                </a>
                                <a href="${plusPantauanOrangTua}" class="btn icon btn-sm btn-primary" title="Pantauan Orang Tua">
                                    <i class="bi bi-file-medical-fill"></i>
                                </a>
                                <a href="${imunisasi}" class="btn icon btn-sm btn-warning" title="Imunisasi">
                                    <i class="fas fa-syringe"></i>
                                </a>
                            `;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/posyandu-management/kunjungan/${data}`;
                            let editUrl = `/posyandu-management/kunjungan/${data}/edit`;

                            return `
                                <a href="${showUrl}" class="btn icon btn-sm btn-info" title="View Details">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="${editUrl}" class="btn icon btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;
                        }
                    }
                ],
                autoWidth: false,
                drawCallback: function(settings) {
                    $('a').tooltip();
                }
            });

            $('#filterTanggal').on('change', function() {
                dataMaster.ajax.reload();
            });

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
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: '{{ session('error') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif

            @if (session('status'))
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: '{{ session('status') }}',
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
                    const url = `/posyandu-management/kunjungan/${id}`;
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Dihapus!',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                                $('#KunjunganTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: response.message || 'Terjadi kesalahan.',
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                            }
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Tidak dapat menghubungi server.',
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
        }
    </script>
@endpush
