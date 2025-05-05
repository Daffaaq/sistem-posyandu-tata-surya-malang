@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Kehamilan</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kehamilan.index') }}"
                            class="{{ request()->routeIs('kehamilan.index') ? 'active' : '' }}">
                            Kehamilan
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">
                <div class="row">
                    {{-- Data Orang Tua --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="text-muted mb-2">Data Orang Tua</h6>
                        <div class="p-3 border rounded bg-light">
                            <p class="mb-1"><strong>Nama Ayah:</strong> {{ $kehamilan->orangTua->nama_ayah }}</p>
                            <p class="mb-0"><strong>Nama Ibu:</strong> {{ $kehamilan->orangTua->nama_ibu }}</p>
                        </div>
                    </div>

                    {{-- Informasi Kehamilan --}}
                    <div class="col-md-6 mb-4">
                        <h6 class="text-muted mb-2">Informasi Kehamilan</h6>
                        <div class="p-3 border rounded bg-light">
                            <p class="mb-1"><strong>Mulai Kehamilan:</strong> {{ $kehamilan->tanggal_mulai_kehamilan }}
                            </p>
                            <p class="mb-1"><strong>Prediksi Lahir:</strong> {{ $kehamilan->prediksi_tanggal_lahir }}</p>
                            <p class="mb-0">
                                <strong>Status:</strong>
                                <span
                                    class="badge text-white bg-{{ $kehamilan->status_kehamilan == 'Hamil' ? 'success' : ($kehamilan->status_kehamilan == 'Melahirkan' ? 'primary' : 'danger') }}">
                                    {{ $kehamilan->status_kehamilan }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Riwayat Pemeriksaan --}}
                <hr>
                <h6 class="text-muted mb-3">Riwayat Pemeriksaan Kehamilan</h6>
                <hr>


                @if ($kehamilan->pemeriksaanKehamilans->isEmpty())
                    <div class="alert alert-info">Belum ada data pemeriksaan kehamilan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="PemeriksaanTable">
                            <thead style="background-color: blue; color: white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Tekanan Darah</th>
                                    <th scope="col">Berat Badan</th>
                                    <th scope="col">Posisi Janin</th>
                                    <th scope="col">Usia Kandungan</th>
                                    <th scope="col">Action</th> <!-- Menambahkan Kolom Action -->
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
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
    {{-- DataTables + Bootstrap 5 CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

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

        #PemeriksaanTable td,
        #PemeriksaanTable th {
            padding: 12px;
            /* Memberikan ruang yang lebih lebar di seluruh kolom */
            text-align: center;
            /* Menyelaraskan teks di tengah secara default */
        }

        #PemeriksaanTable td:nth-child(3),
        #PemeriksaanTable td:nth-child(4),
        #PemeriksaanTable td:nth-child(7) {
            text-align: left;
            /* Menyelaraskan teks kiri untuk kolom tertentu */
            padding-left: 20px;
            /* Memberikan sedikit ruang ekstra pada kolom tersebut */
            padding-right: 20px;
            /* Memberikan ruang agar teks tidak terlalu dekat dengan tepi */
            word-wrap: break-word;
            /* Menjaga teks panjang tetap rapi dan tidak meluber */
        }

        #PemeriksaanTable th {
            background-color: #007bff;
            /* Menambahkan warna latar belakang biru pada header */
            color: white;
            /* Membuat teks header berwarna putih */
            font-weight: bold;
            /* Membuat teks header tebal untuk visibilitas */
            text-align: center;
            /* Menyelaraskan teks di tengah pada header */
        }

        #PemeriksaanTable td {
            vertical-align: middle;
            /* Menyelaraskan konten dalam sel secara vertikal */
        }

        #PemeriksaanTable tbody tr:hover {
            background-color: rgb(209, 209, 209);
            /* Menambahkan efek hover untuk baris tabel */
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
                    url: '{{ route('pemeriksaan.kehamilan.list', ['id' => $kehamilan->id]) }}',
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
                        data: 'tanggal_pemeriksaan_kehamilan',
                        name: 'tanggal_pemeriksaan_kehamilan'
                    },
                    {
                        data: 'deskripsi_pemeriksaan_kehamilan',
                        name: 'deskripsi_pemeriksaan_kehamilan',
                        createdCell: function(td) {
                            $(td).addClass('text-justify');
                        }
                    },
                    {
                        data: 'keluhan_kehamilan',
                        name: 'keluhan_kehamilan',
                        render: function(data) {
                            return data ?
                                `<span class="badge bg-danger text-white">${data}</span>` :
                                '<span class="text-muted">-</span>';
                        }
                    },
                    {
                        data: 'tekanan_darah_ibu_hamil',
                        name: 'tekanan_darah_ibu_hamil',
                        render: function(data) {
                            return `<span class="badge bg-info text-white">${data ?? '-'}</span>`;
                        }
                    },
                    {
                        data: 'berat_badan_ibu_hamil',
                        name: 'berat_badan_ibu_hamil',
                        render: function(data) {
                            return data ? `${parseFloat(data).toFixed(1)} kg` : '-';
                        }
                    },
                    {
                        data: 'posisi_janin',
                        name: 'posisi_janin'
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
                            return `<button class="btn btn-info btn-sm" onclick="openModal(${data})">Lihat</button>`;
                        },
                        orderable: false,
                        searchable: false
                    }
                ],
                autoWidth: false
            });
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
@endpush
