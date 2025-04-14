@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal Kunjungan KB</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('keluarga-berencana.index') }}">
                            Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Jadwal Kunjungan</li>
                </ol>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="JadwalKunjunganKBTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Kunjungan</th>
                                <th>Tanggal Kunjungan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables akan mengisi ini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Jadwal Kunjungan KB</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('keluarga-berencana.index') }}">
                            Keluarga Berencana
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Jadwal Kunjungan</li>
                </ol>
            </div>
            <div class="card-body">
                <form id="jadwalKunjunganForm">
                    @csrf
                    <div class="form-group">
                        <label for="ortu">Orang Tua</label>
                        <input type="text" id="ortu" class="form-control @error('ortu') is-invalid @enderror"
                            value="{{ $keluargaBerencana->orangTua->nama_ayah }} - {{ $keluargaBerencana->orangTua->nama_ibu }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="ortu">Jenis keluarga Berencana</label>
                        <input type="text" id="ortu" class="form-control @error('ortu') is-invalid @enderror"
                            value="{{ $keluargaBerencana->kategoriKeluargaBerencana->nama_kategori_keluarga_berencana }}"
                            disabled>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kunjungan_kb_id">Jenis Kunjungan</label>
                        <select name="jenis_kunjungan_kb_id" id="jenis_kunjungan_kb_id"
                            class="form-control @error('jenis_kunjungan_kb_id') is-invalid @enderror">
                            <option value="">-- Pilih Jenis Kunjungan --</option>
                            @foreach ($jenisKunjunganKeluargaBerencana as $jenis)
                                <option value="{{ $jenis->id }}"
                                    {{ old('jenis_kunjungan_kb_id') == $jenis->id ? 'selected' : '' }}>
                                    {{ $jenis->nama_jenis_kunjungan_keluarga_berencana }}
                                </option>
                            @endforeach
                        </select>
                        @error('jenis_kunjungan_kb_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tanggal_kunjungan_kb">Tanggal Kunjungan</label>
                        <input type="date" name="tanggal_kunjungan_kb" id="tanggal_kunjungan_kb"
                            class="form-control @error('tanggal_kunjungan_kb') is-invalid @enderror"
                            value="{{ old('tanggal_kunjungan_kb') }}">
                        @error('tanggal_kunjungan_kb')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#JadwalKunjunganKBTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('keluarga-berencana.jadwal-kunjungan-kb.list', $keluargaBerencana->id) }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_jenis_kunjungan_keluarga_berencana',
                        name: 'nama_jenis_kunjungan_keluarga_berencana'
                    },
                    {
                        data: 'tanggal_kunjungan_kb',
                        name: 'tanggal_kunjungan_kb'
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data) {
                            let edit =
                                `/posyandu-management/keluarga-berencana/${data}/jadwal-kunjungan-kb/edit`;
                            return `
                                <a href="${edit}" class="btn icon btn-sm btn-info">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;
                        }
                    }
                ]
            });
        });

        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/posyandu-management/keluarga-berencana/${id}/jadwal-kunjungan/destroy`,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            $('#JadwalKunjunganKBTable').DataTable().ajax.reload();
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan saat menghapus data.',
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
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
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
        });
        $('#jadwalKunjunganForm').on('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data jadwal kunjungan akan disimpan!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Ya, simpan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = $(this).serialize();
                    let formAction =
                        '{{ route('keluarga-berencana.jadwal-kunjungan-kb.store', $keluargaBerencana->id) }}';

                    $.ajax({
                        url: formAction,
                        method: 'POST',
                        data: formData,
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Berhasil!',
                                    response.message,
                                    'success'
                                );

                                // Reset form
                                $('#jadwalKunjunganForm')[0].reset();

                                // Refresh datatable
                                $('#JadwalKunjunganKBTable').DataTable().ajax.reload();
                            } else {
                                Swal.fire(
                                    'Gagal!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan pada server.',
                                'error'
                            );
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endpush
