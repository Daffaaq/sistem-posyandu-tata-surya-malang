@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Obat</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('obat.index') }}"
                            class="{{ request()->routeIs('obat.index') ? 'active' : '' }}">Obat</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                    <div class="me-3">
                        <label for="filter-tipe" class="form-label fw-bold mb-1">Filter Tipe:</label>
                        <select id="filter-tipe" class="form-select shadow-sm border-primary" style="min-width: 180px;">
                            <option value="">Semua</option>
                            <option value="obat">Obat</option>
                            <option value="vitamin">Vitamin</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column flex-sm-row align-items-start justify-content-start mt-3 mt-sm-0">
                        <!-- Tombol Import Obat -->
                        <a href="{{ route('view.obat.import') }}"
                            class="btn btn-success shadow mb-3 mb-sm-0 me-sm-3 d-flex align-items-center">
                            <i class="fas fa-import me-2"></i> Import Obat
                        </a>

                        <!-- Tombol Tambah Obat -->
                        <a href="{{ route('obat.create') }}"
                            class="btn btn-primary shadow d-flex align-items-center ms-sm-3 mt-3 mt-sm-0">
                            <i class="fas fa-plus me-2"></i> Tambah Obat
                        </a>
                    </div>

                </div>

                <ul class="nav nav-tabs border-bottom border-primary mb-3" id="kadaluarsaTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-primary fw-bold" id="belum-kadaluarsa-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-table1" role="tab">
                            <i class="bi bi-clock-history me-1"></i> Belum Kadaluarsa
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-danger fw-bold" id="sudah-kadaluarsa-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-table2" role="tab">
                            <i class="bi bi-exclamation-triangle me-1"></i> Sudah Kadaluarsa
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-success fw-bold" id="arsip-tab" data-bs-toggle="tab"
                            data-bs-target="#tab-table3" role="tab">
                            <i class="bi bi-archive me-1"></i> Arsip
                        </button>
                    </li>
                </ul>


                <!-- Tab Content -->
                <div class="tab-content pt-2">
                    <!-- Belum Kadaluarsa Table -->
                    <div class="tab-pane show active" id="tab-table1" role="tabpanel">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ObatTable1" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat Vitamin</th>
                                        <th>Tipe</th>
                                        <th>Stok</th>
                                        <th>Tanggal Kadaluarsa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables will fill this -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sudah Kadaluarsa Table -->
                    <div class="tab-pane" id="tab-table2" role="tabpanel">
                        <div class="mb-3">
                            <button class="btn btn-danger" id="arsipkanSemuaBtn">Arsipkan Semua Obat Kadaluarsa</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="ObatTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat Vitamin</th>
                                        <th>Tipe</th>
                                        <th>Stok</th>
                                        <th>Tanggal Kadaluarsa</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- DataTables will fill this -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Arsip Table -->
                    <div class="tab-pane" id="tab-table3" role="tabpanel">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="ArsipObatTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Obat Vitamin</th>
                                        <th>Tipe</th>
                                        <th>Stok</th>
                                        <th>Tanggal Kadaluarsa</th>
                                        <th>Tanggal Arsip</th>
                                        <th>Action</th>
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

        .nav-tabs .nav-link {
            transition: all 0.3s ease;
            border: none;
            padding: 0.75rem 1rem;
            background-color: #f8f9fa;
            margin-right: 5px;
            border-radius: 0.5rem 0.5rem 0 0;
        }

        .nav-tabs .nav-link.active {
            background-color: #e9ecef;
            border-bottom: 3px solid #0d6efd;
            color: #0d6efd;
            font-weight: bold;
        }
    </style>
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Ensure you have these in your 'head' or at the end of 'body' section -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {

            // DataTables initialization for Belum Kadaluarsa tab
            var dataMaster1 = $('#ObatTable1').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('obat.list') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: function(d) {
                        d.tipe_filter = $('#filter-tipe').val(); // Include tipe filter
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
                        data: 'nama_obat_vitamin',
                        name: 'nama_obat_vitamin'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'tanggal_kadaluarsa',
                        name: 'tanggal_kadaluarsa'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/master-management/obat/${data}`;
                            let editUrl = `/master-management/obat/${data}/edit`;
                            return `
                        <a href="${showUrl}" class="btn icon btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="${editUrl}" class="btn icon btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')"><i class="bi bi-trash"></i></button>
                    `;
                        }
                    }
                ]
            });

            // DataTables initialization for Sudah Kadaluarsa tab
            var dataMaster2 = $('#ObatTable2').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('obat.list-kadaluarsa') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: function(d) {
                        d.tipe_filter = $('#filter-tipe').val(); // Include tipe filter
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
                        data: 'nama_obat_vitamin',
                        name: 'nama_obat_vitamin'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'tanggal_kadaluarsa',
                        name: 'tanggal_kadaluarsa'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let showUrl = `/master-management/obat/${data}`;
                            let editUrl = `/master-management/obat/${data}/edit`;
                            return `
                        <a href="${showUrl}" class="btn icon btn-sm btn-info"><i class="bi bi-eye"></i></a>
                        <a href="${editUrl}" class="btn icon btn-sm btn-warning"><i class="bi bi-pencil"></i></a>
                        <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')"><i class="bi bi-trash"></i></button>
                        <button class="btn icon btn-sm btn-secondary" onclick="arsipkanObat('${data}')"><i class="bi bi-archive"></i></button>
                    `;
                        }
                    }
                ]
            });

            // DataTables initialization for arsip obat
            var dataMasterArsip = $('#ArsipObatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('obat.list-arsip') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: function(d) {
                        d.tipe_filter = $('#filter-tipe').val(); // Include tipe filter
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
                        data: 'nama_obat',
                        name: 'nama_obat'
                    },
                    {
                        data: 'tipe',
                        name: 'tipe'
                    },
                    {
                        data: 'stok',
                        name: 'stok'
                    },
                    {
                        data: 'tanggal_kadaluarsa',
                        name: 'tanggal_kadaluarsa'
                    },
                    {
                        data: 'tanggal_arsip_obat',
                        name: 'tanggal_arsip_obat'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let unarchiveUrl = `/master-management/obat/unarchive/${data}`;
                            return `
                        <button class="btn icon btn-sm btn-success" onclick="unarchiveObat('${data}')"><i class="bi bi-archive"></i></button>
                    `;
                        }
                    }
                ]
            });

            // Filter change event
            $('#filter-tipe').on('change', function() {
                const activeTab = $('#kadaluarsaTab .nav-link.active').attr('id');

                if (activeTab === 'belum-kadaluarsa-tab') {
                    dataMaster1.ajax.reload();
                } else if (activeTab === 'sudah-kadaluarsa-tab') {
                    dataMaster2.ajax.reload();
                } else if (activeTab === 'arsip-tab') {
                    ArsipObatTable.ajax.reload();
                }
            });

            $('#kadaluarsaTab button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                const targetTab = $(e.target).attr('id'); // ID tab aktif

                // Reset filter ke "Semua"
                $('#filter-tipe').val('');

                // Reload DataTable sesuai tab aktif
                if (targetTab === 'belum-kadaluarsa-tab') {
                    dataMaster1.ajax.reload();
                } else if (targetTab === 'sudah-kadaluarsa-tab') {
                    dataMaster2.ajax.reload();
                } else if (targetTab === 'arsip-tab') {
                    ArsipObatTable.ajax.reload();
                }
            });

            // Event handler untuk tombol arsipkan semua
            $('#arsipkanSemuaBtn').click(function() {
                // Menggunakan SweetAlert untuk konfirmasi
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Semua obat kadaluarsa akan diarsipkan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, arsipkan!',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim permintaan POST ke server untuk arsipkan semua obat kadaluarsa
                        $.ajax({
                            url: '{{ route('obat.arsipkan.semua') }}', // URL untuk route arsipkan semua
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}', // CSRF token untuk keamanan
                            },
                            success: function(response) {
                                if (response.success) {
                                    // Tampilkan SweetAlert untuk sukses
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Arsipkan Berhasil!',
                                        text: response.message,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                    });
                                    // Refresh DataTables setelah arsipkan semua
                                    dataMaster2.ajax.reload();
                                    dataMasterArsip.ajax.reload();
                                } else {
                                    // Tampilkan SweetAlert untuk error
                                    Swal.fire(
                                        'Gagal!',
                                        response.message,
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                let res = xhr.responseJSON;
                                let icon = res.status === 'info' ? 'info' : res
                                    .status === 'warning' ? 'warning' : 'error';

                                Swal.fire({
                                    icon: icon,
                                    title: res.status === 'info' ? 'Info' :
                                        'Gagal!',
                                    text: res.message || 'Terjadi kesalahan.',
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



            // Success Toast (optional)
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

            // Error Toast (optional)
            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: '{{ session('error') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif

        });

        function unarchiveObat(id) {
            Swal.fire({
                title: 'Yakin ingin memulihkan obat ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pulihkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/master-management/obat/unarchive/${id}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#ArsipObatTable').DataTable().ajax.reload(); // atau tabel lainnya
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: xhr.responseJSON.message || 'Terjadi kesalahan.',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                        }
                    });
                }
            });
        }

        function arsipkanObat(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Obat ini akan dipindahkan ke arsip!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Arsipkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Mengirim request POST ke server
                    const url = `/master-management/obat/arsipkan/${id}`;
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Arsipkan Berhasil!',
                                    text: response.message,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                });
                                // Reload tabel untuk memperbarui data
                                $('#ObatTable2').DataTable().ajax.reload();
                                $('#ArsipObatTable').DataTable().ajax.reload();
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
                        error: function(xhr) {
                            let res = xhr.responseJSON;
                            let icon = res.status === 'info' ? 'info' : res.status === 'warning' ?
                                'warning' : 'error';

                            Swal.fire({
                                icon: icon,
                                title: res.status === 'info' ? 'Info' : 'Gagal!',
                                text: res.message || 'Terjadi kesalahan.',
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
                    const url = `/master-management/obat/${id}`;
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
                                $('#ObatTable').DataTable().ajax.reload();
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
