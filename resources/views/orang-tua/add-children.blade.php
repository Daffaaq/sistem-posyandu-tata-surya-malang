@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('orang-tua.index') }}"
                            class="{{ request()->routeIs('orang-tua.index') ? 'active' : '' }}">Orang Tua</a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Tabel List Anak (di atas form) -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="AnakTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Jenis Kelamin</th>
                                <th>Tanggal Lahir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui DataTables -->
                        </tbody>
                    </table>
                </div>

                {{-- <!-- Form untuk Menambah Anak (di bawah tabel) -->
                <div class="mt-4">
                    <h5>Tambah Anak</h5>
                    <form action="{{ route('orang-tua.add-children', $orangTua->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div id="children-container">
                            <!-- Form Anak pertama akan ditampilkan di sini -->
                            <div class="child-form mb-3">
                                <div class="form-group">
                                    <label for="nama_anak">Nama Anak</label>
                                    <input type="text" name="children[0][nama_anak]" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin_anak">Jenis Kelamin</label>
                                    <select name="children[0][jenis_kelamin_anak]" class="form-control" required>
                                        <option value="Laki-laki">Laki-laki</option>
                                        <option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir_anak">Tanggal Lahir</label>
                                    <input type="date" name="children[0][tanggal_lahir_anak]" class="form-control"
                                        required>
                                </div>
                                <input type="hidden" name="children[0][orang_tua_id]" value="{{ $orangTua->id }}">

                                <!-- Tombol Hapus -->
                                <button type="button" class="btn btn-danger btn-sm remove-child-btn">Hapus</button>
                            </div>
                        </div>

                        <button type="button" id="add-child-btn" class="btn btn-primary mb-3">Tambah Anak</button>
                        <button type="submit" class="btn btn-success">Simpan Anak</button>
                    </form>
                </div> --}}
            </div>
        </div>
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tambah Anak</h6>
            </div>
            <div class="card-body">
                <!-- Form untuk Menambah Anak (di bawah tabel) -->
                <form action="{{ route('orang-tua.add-children', $orangTua->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div id="children-container">
                        <!-- Form Anak pertama akan ditampilkan di sini -->
                        <div class="child-form mb-3">
                            <div class="form-group">
                                <label for="nama_anak">Nama Anak</label>
                                <input type="text" name="children[0][nama_anak]" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin_anak">Jenis Kelamin</label>
                                <select name="children[0][jenis_kelamin_anak]" class="form-control" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir_anak">Tanggal Lahir</label>
                                <input type="date" name="children[0][tanggal_lahir_anak]" class="form-control" required>
                            </div>
                            <input type="hidden" name="children[0][orang_tua_id]" value="{{ $orangTua->id }}">

                            <!-- Tombol Hapus -->
                            {{-- <button type="button" class="btn btn-danger btn-sm remove-child-btn">Hapus</button> --}}
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" id="add-child-btn" class="btn btn-primary mb-3">Tambah Anak</button>
                        <button type="submit" class="btn btn-success mb-3">Simpan Anak</button>
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

        .child-form {
            margin-bottom: 20px;
            padding: 20px;
            border: 2px solid #ddd;
            /* memberikan border */
            border-radius: 8px;
            /* membuat sudutnya bulat */
            background-color: #f9f9f9;
            /* memberi latar belakang */
        }

        .child-form+.child-form {
            margin-top: 20px;
            /* memberi jarak antar form anak */
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            var orangTuaId = {{ $orangTua->id }}; // Ambil ID Orang Tua

            $('#AnakTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('orang-tua.list-children', ':id') }}'.replace(':id', orangTuaId),
                    type: 'POST',
                    data: function(d) {
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
                        data: 'nama_anak',
                        name: 'nama_anak'
                    },
                    {
                        data: 'jenis_kelamin_anak',
                        name: 'jenis_kelamin_anak'
                    },
                    {
                        data: 'tanggal_lahir_anak',
                        name: 'tanggal_lahir_anak'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let editUrl =
                                `/user-management/orang-tua/view-form-edit/children/${data}`;

                            return `
                                 <a href="${editUrl}" class="btn icon btn-sm btn-warning">
                                     <i class="bi bi-pencil"></i>
                                 </a>
                                 <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')">
                                     <i class="bi bi-trash"></i>
                                 </button>
                             `;
                        }
                    },
                ]
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
        });

        function confirmDelete(childId) {
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
                    const url =
                        `/user-management/orang-tua/children/delete/${childId}`; // Sesuaikan URL dengan endpoint penghapusan anak
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
                                $('#AnakTable').DataTable().ajax.reload(); // Reload data table
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
        $(document).ready(function() {
            let childCount = 1; // To track the number of added children form fields

            // Tambah form Anak secara dinamis
            $('#add-child-btn').click(function() {
                const newChildForm = `
                    <div class="child-form mb-3">
                        <div class="form-group">
                            <label for="nama_anak">Nama Anak</label>
                            <input type="text" name="children[${childCount}][nama_anak]" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin_anak">Jenis Kelamin</label>
                            <select name="children[${childCount}][jenis_kelamin_anak]" class="form-control" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_anak">Tanggal Lahir</label>
                            <input type="date" name="children[${childCount}][tanggal_lahir_anak]" class="form-control" required>
                        </div>

                        <!-- Tombol Hapus -->
                        <button type="button" class="btn btn-danger btn-sm remove-child-btn">Hapus</button>
                    </div>
                `;
                $('#children-container').append(newChildForm);
                childCount++; // Increment to track next child index
            });

            // Hapus form anak yang ditambahkan
            $(document).on('click', '.remove-child-btn', function() {
                $(this).closest('.child-form').remove(); // Menghapus form anak yang bersangkutan
                childCount--; // Decrement to track next child index correctly
            });
        });
    </script>
@endpush
