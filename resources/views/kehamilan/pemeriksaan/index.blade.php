@extends('layouts.app')

@section('content')
    {{-- data kehamilan --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pemeriksaan.kehamilan.index', ['id' => $kehamilan->id]) }}"
                            class="{{ request()->routeIs('pemeriksaan.kehamilan.index') ? 'active' : '' }}">
                            Pemeriksaan Kehamilan
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="KehamilanTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Orang Tua</th>
                                <th>Status Kehamilan</th>
                                <th>Tanggal Mulai</th>
                                <th>Prediksi Lahir</th>
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
    {{-- data pemeriksaan --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Pemeriksaan Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pemeriksaan.kehamilan.index', ['id' => $kehamilan->id]) }}"
                            class="{{ request()->routeIs('pemeriksaan.kehamilan.index') ? 'active' : '' }}">
                            Pemeriksaan Kehamilan
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="PemeriksaanTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Orang Tua</th>
                                <th>Tanggal</th>
                                <th>Usia Kandungan</th>
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
    {{-- form pemeriksaan --}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pemeriksaan Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('pemeriksaan.kehamilan.index', ['id' => $kehamilan->id]) }}"
                            class="{{ request()->routeIs('pemeriksaan.kehamilan.index') ? 'active' : '' }}">
                            Pemeriksaan Kehamilan
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <form action="{{ route('pemeriksaan.kehamilan.store', ['id' => $kehamilan->id]) }}" method="POST">
                    @csrf

                    <div id="pemeriksaan-wrapper">
                        <div class="pemeriksaan-group card mb-3 p-3 bg-light border">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                                    <input type="date" name="pemeriksaans[0][tanggal_pemeriksaan_kehamilan]"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Deskripsi <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Masukkan deskripsi pemeriksaan"
                                        name="pemeriksaans[0][deskripsi_pemeriksaan_kehamilan]" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Keluhan</label>
                                    <input type="text" placeholder="Masukkan keluhan (opsional)"
                                        name="pemeriksaans[0][keluhan_kehamilan]" class="form-control">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Tekanan Darah <span class="text-danger">*</span></label>
                                    <input type="text" placeholder="Contoh: 120/80"
                                        name="pemeriksaans[0][tekanan_darah_ibu_hamil]" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berat Badan Ibu <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" min="30" max="10000"
                                        placeholder="Contoh: 45.5" name="pemeriksaans[0][berat_badan_ibu_hamil]"
                                        class="form-control" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Posisi Janin <span class="text-danger">*</span></label>
                                    <input type="text" name="pemeriksaans[0][posisi_janin]" class="form-control"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Usia Kandungan <span class="text-danger">*</span></label>
                                    <input type="number" min="1" max="42" placeholder="Contoh: 12"
                                        name="pemeriksaans[0][usia_kandungan]" class="form-control" required>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-end justify-content-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-btn d-none">Hapus
                                        Pemeriksaan</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button type="button" id="addPemeriksaan" class="btn btn-primary btn-sm">+ Tambah
                            Pemeriksaan</button>
                    </div>

                    <button type="submit" class="btn btn-success">Simpan Semua Pemeriksaan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid mb-3">
        <a href="{{ route('kehamilan.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left-circle"></i> Kembali ke Data Kehamilan
        </a>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pemeriksaan Kehamilan</h5>
                    <button type="button" class="btn-close" id="closeModal" data-bs-dismiss="modal"
                        aria-label="Close"><i class="bi bi-x"></i></button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">
                        <!-- Konten akan diisi dengan data -->
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
    </style>
@endpush
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#PemeriksaanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('pemeriksaan.kehamilan.list1', ['id' => $kehamilan->id]) }}',
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
                        data: 'orang_tua',
                        name: 'orang_tua'
                    },
                    {
                        data: 'tanggal_pemeriksaan_kehamilan',
                        name: 'tanggal_pemeriksaan_kehamilan'
                    },
                    {
                        data: 'usia_kandungan',
                        name: 'usia_kandungan',
                        render: function(data) {
                            return `<span class="badge bg-warning text-white">${data} minggu</span>`;
                        }
                    },
                    {
                        data: 'id', // Menambahkan Action Button
                        name: 'id',
                        render: function(data, type, row) {
                            let editUrl = `/pregnant-management/kehamilan/${data}/edit`;
                            return `<a href="${editUrl}" class="btn icon btn-sm btn-warning" data-bs-toggle="tooltip" title="Edit Data">
                                        <i class="bi bi-pencil"></i>
                                        </a>
                                        <button class="btn btn-info btn-sm" onclick="openModal(${data})" data-bs-toggle="tooltip" title="Lihat Data"><i class="bi bi-eye"></i></button>
                                        <button class="btn icon btn-sm btn-danger" onclick="confirmDelete('${data}')" data-bs-toggle="tooltip" title="Hapus Data">
                                        <i class="bi bi-trash"></i>
                                    </button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                autoWidth: false
            });
            var dataMaster = $('#KehamilanTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kehamilan.list') }}',
                    type: 'POST',
                    dataType: 'json',
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
                        data: 'orang_tua',
                        name: 'orang_tua'
                    },
                    {
                        data: 'status_kehamilan',
                        name: 'status_kehamilan'
                    },
                    {
                        data: 'tanggal_mulai_kehamilan',
                        name: 'tanggal_mulai_kehamilan'
                    },
                    {
                        data: 'prediksi_tanggal_lahir',
                        name: 'prediksi_tanggal_lahir'
                    }
                ],
                autoWidth: false,
                drawCallback: function(settings) {
                    $('a').tooltip();
                }
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

        function openModal(id) {
            // Ambil data pemeriksaan dengan ID
            $.ajax({
                url: '{{ route('pemeriksaan.kehamilan.show', ':id') }}'.replace(':id',
                    id), // Pastikan rute ini mengarah ke controller yang sesuai
                type: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Cek apakah respons berhasil
                    if (response.success) {
                        const data = response.data;
                        let modalContent = `
                    <p><strong>Tanggal Pemeriksaan:</strong> ${data.tanggal_pemeriksaan_kehamilan}</p>
                    <p><strong>Deskripsi Pemeriksaan:</strong> ${data.deskripsi_pemeriksaan_kehamilan}</p>
                    <p><strong>Keluhan:</strong> ${data.keluhan_kehamilan ? data.keluhan_kehamilan : '-'}</p>
                    <p><strong>Tekanan Darah:</strong> ${data.tekanan_darah_ibu_hamil ?? '-'}</p>
                    <p><strong>Berat Badan:</strong> ${data.berat_badan_ibu_hamil ? parseFloat(data.berat_badan_ibu_hamil).toFixed(1) + ' kg' : '-'}</p>
                    <p><strong>Posisi Janin:</strong> ${data.posisi_janin}</p>
                    <p><strong>Usia Kandungan:</strong> ${data.usia_kandungan} minggu</p>
                `;
                        $('#modalContent').html(modalContent);
                        $('#detailModal').modal('show');
                    } else {
                        alert('Data tidak ditemukan');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat mengambil data');
                }
            });
        }
        document.getElementById('closeModal').addEventListener('click', function() {
            const modalElement = document.getElementById('detailModal');
            console.log
            $('#modalContent').html('');
            $('#detailModal').modal('hide');
        });
    </script>
    <script>
        let index = 1;

        $('#addPemeriksaan').click(function() {
            let newGroup = $('.pemeriksaan-group').first().clone();

            newGroup.find('input').each(function() {
                let name = $(this).attr('name');
                name = name.replace(/\[\d+\]/, `[${index}]`);
                $(this).attr('name', name).val('');
            });

            // Tampilkan tombol hapus pada form baru
            newGroup.find('.remove-btn').removeClass('d-none');

            $('#pemeriksaan-wrapper').append(newGroup);
            index++;
        });

        $(document).on('click', '.remove-btn', function() {
            if ($('.pemeriksaan-group').length > 1) {
                $(this).closest('.pemeriksaan-group').remove();
            }
        });
    </script>
@endpush
