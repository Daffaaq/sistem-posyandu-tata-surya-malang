@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Card Tanggal Kunjungan -->
        <div class="card shadow mb-4">
            <div class="card-header py-3"
                style="background: linear-gradient(135deg, #28a745, #1a73e8); border-bottom: 2px solid #f1f3f4;">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column" id="tanggal-kunjungan">
                        <strong class="mb-1" style="font-size: 1.2rem; color: #ffffff;">Tanggal Kunjungan:</strong>
                        <span style="font-size: 1.5rem; color: #ffffff;">
                            {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->locale('id')->isoFormat('D MMMM YYYY') }}
                        </span>
                    </div>
                    <i class="fas fa-calendar-day text-white" style="font-size: 1.75rem;"></i>
                </div>
            </div>
        </div>


        <!-- Card Pemantauan Ayah -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pemantauan Ayah</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
                            Kunjungan
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.pantauan-tumbuh-kembang-anak', $kunjungan->id) }}"
                            class="{{ request()->routeIs('kunjungan.pantauan-tumbuh-kembang-anak') ? 'active' : '' }}">
                            Show Analitics Parents
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">

                <!-- Tabel Pemantauan Ayah -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="PemantauanAyahTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ayah</th>
                                <th>Tanggal Pemeriksaan Ibu</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Card Pemantauan ibu -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pemantauan Ibu</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
                            Kunjungan
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.pantauan-tumbuh-kembang-anak', $kunjungan->id) }}"
                            class="{{ request()->routeIs('kunjungan.pantauan-tumbuh-kembang-anak') ? 'active' : '' }}">
                            Show Analitics Parents
                        </a>
                    </li>
                </ol>
            </div>

            <div class="card-body">

                <!-- Tabel Pemantauan Ibu -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="PemantauanIbuTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ibu</th>
                                <th>Tanggal Pemeriksaan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Form Pemantauan Orang Tua</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
                            Kunjungan
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.pantauan-tumbuh-kembang-anak', $kunjungan->id) }}"
                            class="{{ request()->routeIs('kunjungan.pantauan-tumbuh-kembang-anak') ? 'active' : '' }}">
                            Show Analitics Growth Children
                        </a>
                    </li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Form untuk menambahkan Pemantauan Tumbuh Kembang Anak -->
                <form method="POST" action="{{ route('kunjungan.store-pemantauan-orang-tua', $kunjungan->id) }}">
                    @csrf
                    @method('PUT')

                    {{-- Checkbox Pemeriksaan --}}
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="periksa_ayah" name="periksa_ayah" checked>
                            <label class="form-check-label" for="periksa_ayah">Periksa Ayah</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="periksa_ibu" name="periksa_ibu" checked>
                            <label class="form-check-label" for="periksa_ibu">Periksa Ibu</label>
                        </div>
                    </div>

                    {{-- Form Pemeriksaan Ayah --}}
                    <div id="form_ayah">
                        <h5>Pemeriksaan Ayah</h5>
                        <div class="form-group">
                            <label>Tekanan Darah Ayah</label>
                            <input type="text" name="tekanan_darah_ayah" class="form-control"
                                placeholder="Contoh: 120/80">
                        </div>
                        <div class="form-group">
                            <label>Gula Darah Ayah</label>
                            <input type="number" name="gula_darah_ayah" class="form-control" placeholder="Contoh: 100">
                        </div>
                        <div class="form-group">
                            <label>Kolesterol Ayah</label>
                            <input type="number" name="kolesterol_ayah" class="form-control" placeholder="Contoh: 200">
                        </div>
                        <div class="form-group">
                            <label>Catatan Kesehatan Ayah</label>
                            <textarea name="catatan_kesehatan_ayah" class="form-control" placeholder="Masukkan catatan kesehatan ayah"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pemeriksaan Lanjutan Ayah</label>
                            <input type="date" name="tanggal_pemeriksaan_lanjutan_ayah" class="form-control">
                        </div>
                    </div>

                    {{-- Form Pemeriksaan Ibu --}}
                    <div id="form_ibu">
                        <h5>Pemeriksaan Ibu</h5>
                        <div class="form-group">
                            <label>Tekanan Darah Ibu</label>
                            <input type="text" name="tekanan_darah_ibu" class="form-control"
                                placeholder="Contoh: 120/80">
                        </div>
                        <div class="form-group">
                            <label>Gula Darah Ibu</label>
                            <input type="number" name="gula_darah_ibu" class="form-control" placeholder="Contoh: 100">
                        </div>
                        <div class="form-group">
                            <label>Kolesterol Ibu</label>
                            <input type="number" name="kolesterol_ibu" class="form-control" placeholder="Contoh: 200">
                        </div>
                        <div class="form-group">
                            <label>Catatan Kesehatan Ibu</label>
                            <textarea name="catatan_kesehatan_ibu" class="form-control" placeholder="Masukkan catatan kesehatan ibu"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Pemeriksaan Lanjutan Ibu</label>
                            <input type="date" name="tanggal_pemeriksaan_lanjutan_ibu" class="form-control">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </form>
            </div>
        </div>


    </div>
@endsection

@push('styles')
    <style>
        /* Custom Styles */
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

        #anak-checkboxes {
            display: flex;
            flex-wrap: wrap;
        }

        .form-check {
            margin-right: 15px;
            margin-bottom: 10px;
        }

        #tanggal-kunjungan {
            display: flex;
            flex-direction: column;
        }

        #tanggal-kunjungan strong {
            font-size: 1rem;
            color: #333;
            margin-bottom: 5px;
        }

        #tanggal-kunjungan span {
            font-size: 1.125rem;
            color: #6c757d;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            var kunjunganId = {{ $kunjungan->id }};
            // DataTable untuk Pemantauan Ayah
            $('#PemantauanAyahTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kunjungan.list-pemantauan-ayah', ':id') }}'.replace(':id',
                        kunjunganId),
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
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal_pemeriksaan',
                        name: 'tanggal_pemeriksaan'
                    },
                    {
                        data: 'pemeriksaan_id',
                        name: 'pemeriksaan_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let showUrl =
                                `/posyandu-management/kunjungan/${data}/show-data-pemeriksaan-ayah`;

                            return `
        <a href="${showUrl}" class="btn icon btn-sm btn-info mb-1" title="Pantauan Tumbuh Kembang Anak">
            <i class="bi bi-eye-fill"></i>
        </a>
    `;
                        }
                    }
                ]
            });

            // DataTable untuk Pemantauan Ibu
            $('#PemantauanIbuTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kunjungan.list-pemantauan-ibu', ':id') }}'.replace(':id', kunjunganId),
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
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'tanggal_pemeriksaan',
                        name: 'tanggal_pemeriksaan'
                    },
                    {
                        data: 'pemeriksaan_id',
                        name: 'pemeriksaan_id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let showUrl =
                                `/posyandu-management/kunjungan/${data}/show-data-pemeriksaan-ibu`;

                            return `
        <a href="${showUrl}" class="btn icon btn-sm btn-info mb-1" title="Pantauan Tumbuh Kembang Anak">
            <i class="bi bi-eye-fill"></i>
        </a>
    `;
                        }
                    }
                ]
            });
        });

        // form
        $(document).ready(function() {
            function toggleForms() {
                $('#form_ayah').toggle($('#periksa_ayah').is(':checked'));
                $('#form_ibu').toggle($('#periksa_ibu').is(':checked'));
            }

            $('#periksa_ayah, #periksa_ibu').on('change', function() {
                toggleForms();
            });

            toggleForms(); // Inisialisasi saat load
        });
    </script>
@endpush
