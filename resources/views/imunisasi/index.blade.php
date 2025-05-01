@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Imunisasi Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item active">Imunisasi</li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Tabs anak -->
                <ul class="nav nav-tabs mb-3" id="anakTabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-nama="Semua">Semua</a>
                    </li>
                    @foreach ($anaks as $anak)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-nama="{{ $anak->nama_anak }}">{{ $anak->nama_anak }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="table-responsive">
                    <table class="table table-bordered" id="ImunisasiTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Kategori Imunisasi</th>
                                <th>Tanggal Imunisasi</th>
                                <th>Tanggal Imunisasi Lanjutan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Obat Imunisasi Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">Kunjungan</a>
                    </li>
                    <li class="breadcrumb-item active">Imunisasi</li>
                </ol>
            </div>
            <div class="card-body">
                <!-- Tabs anak -->
                <ul class="nav nav-tabs mb-3" id="anakTabs1">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-nama="Semua">Semua</a>
                    </li>
                    @foreach ($anaks as $anak)
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-nama="{{ $anak->nama_anak }}">{{ $anak->nama_anak }}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="table-responsive">
                    <table class="table table-bordered" id="ObatImunisasiTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Input Imunisasi Anak</h6>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('kunjungan.index') }}"
                            class="{{ request()->routeIs('kunjungan.index') ? 'active' : '' }}">
                            Kunjungan
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Input Imunisasi</li>
                </ol>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('imunisasi.store', $kunjungan->id) }}">
                    @csrf

                    <div class="form-group">
                        <label for="anak_id">Pilih Anak:</label><br>
                        @foreach ($anaks as $anak)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input anak-checkbox" type="checkbox" name="anak_id[]"
                                    value="{{ $anak->id }}" id="anakCheckbox{{ $anak->id }}">
                                <label class="form-check-label"
                                    for="anakCheckbox{{ $anak->id }}">{{ $anak->nama_anak }}</label>
                            </div>
                        @endforeach
                    </div>

                    <hr>

                    <div id="anak-forms">
                        @foreach ($anaks as $anak)
                            <div class="anak-form mb-4 p-3 border rounded" id="form-anak-{{ $anak->id }}"
                                style="display: none;">
                                <h5 class="text-primary">{{ $anak->nama_anak }}</h5>

                                <div class="form-group">
                                    <label>Kategori Imunisasi:</label>
                                    @foreach ($kategoriImunisasi as $index => $kategori)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox"
                                                name="kategori_imunisasi_id[{{ $anak->id }}][]"
                                                value="{{ $kategori->id }}"
                                                id="kategori_{{ $anak->id }}_{{ $kategori->id }}"
                                                data-anak="{{ $anak->id }}" data-index="{{ $index }}">

                                            <label class="form-check-label"
                                                for="kategori_{{ $anak->id }}_{{ $kategori->id }}">
                                                {{ $kategori->nama_kategori_imunisasi }}
                                            </label>
                                        </div>

                                        <div class="form-group ml-4">
                                            <label>Tanggal Imunisasi Lanjutan (Opsional) -
                                                {{ $kategori->nama_kategori_imunisasi }}:</label>
                                            <input type="date"
                                                name="tanggal_imunisasi_lanjutan[{{ $anak->id }}][{{ $index }}]"
                                                class="form-control tanggal-lanjutan" data-anak="{{ $anak->id }}"
                                                data-index="{{ $index }}">
                                        </div>
                                    @endforeach

                                </div>

                                <div class="form-group">
                                    <label>Obat yang Digunakan:</label>
                                    @foreach ($obats as $obat)
                                        <div class="form-check">
                                            <input class="form-check-input obat-checkbox" type="checkbox"
                                                name="obat_id[{{ $anak->id }}][0][]" value="{{ $obat->id }}"
                                                id="obat_{{ $anak->id }}_{{ $obat->id }}">

                                            <label class="form-check-label"
                                                for="obat_{{ $anak->id }}_{{ $obat->id }}">
                                                {{ $obat->nama_obat_vitamin }} (Stok: {{ $obat->stok }})
                                            </label>

                                            <div class="jumlah-obat-wrapper mt-1" style="display: none;">
                                                <input type="number"
                                                    name="jumlah_obat[{{ $anak->id }}][0][{{ $obat->id }}]"
                                                    class="form-control" placeholder="Jumlah" min="1" disabled>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <a class="btn btn-secondary" href="{{ route('kunjungan.index') }}">Cancel</a>
                            <button type="submit" class="btn btn-primary">Simpan Imunisasi</button>
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
    <script>
        $(document).ready(function() {
            let selectedNama = '';

            var table = $('#ImunisasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('list.imunisasi-anak', $kunjungan->id) }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        if (selectedNama && selectedNama !== 'Semua') {
                            d.nama_anak = selectedNama;
                        }
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
                        name: 'nama_anak',
                        visible: true
                    },
                    {
                        data: 'nama_kategori_imunisasi',
                        name: 'nama_kategori_imunisasi'
                    },
                    {
                        data: 'tanggal_imunisasi',
                        name: 'tanggal_imunisasi'
                    },
                    {
                        data: 'tanggal_imunisasi_lanjutan',
                        name: 'tanggal_imunisasi_lanjutan'
                    }
                ]
            });

            $('#anakTabs a').on('click', function(e) {
                e.preventDefault();
                $('#anakTabs a').removeClass('active');
                $(this).addClass('active');

                selectedNama = $(this).data('nama');

                // Atur visibilitas kolom "Nama Anak"
                let column = table.column(
                    1); // kolom ke-1 berarti kolom ke-2 secara visual (index dimulai dari 0)
                if (selectedNama !== 'Semua') {
                    column.visible(false);
                } else {
                    column.visible(true);
                }

                table.ajax.reload();
            });
        });
        $(document).ready(function() {
            let selectedNama = '';

            var table = $('#ObatImunisasiTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('list.obat-imunisasi-anak', $kunjungan->id) }}',
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        if (selectedNama && selectedNama !== 'Semua') {
                            d.nama_anak = selectedNama;
                        }
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
                        name: 'nama_anak',
                        visible: true
                    },
                    {
                        data: 'nama_obat_vitamin',
                        name: 'nama_obat_vitamin'
                    },
                    {
                        data: 'jumlah_obat',
                        name: 'jumlah_obat'
                    },
                ]
            });

            $('#anakTabs1 a').on('click', function(e) {
                e.preventDefault();
                $('#anakTabs1 a').removeClass('active');
                $(this).addClass('active');

                selectedNama = $(this).data('nama');

                // Atur visibilitas kolom "Nama Anak"
                let column = table.column(
                    1); // kolom ke-1 berarti kolom ke-2 secara visual (index dimulai dari 0)
                if (selectedNama !== 'Semua') {
                    column.visible(false);
                } else {
                    column.visible(true);
                }

                table.ajax.reload();
            });
        });
    </script>
    <script>
        // Toggle form anak saat checkbox anak diklik
        document.querySelectorAll('.anak-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const anakId = this.value;
                const formDiv = document.getElementById('form-anak-' + anakId);
                formDiv.style.display = this.checked ? 'block' : 'none';
            });
        });

        // Tampilkan input jumlah hanya jika checkbox obat dicentang
        document.querySelectorAll('.obat-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const wrapper = this.closest('.form-check').querySelector('.jumlah-obat-wrapper');
                const input = wrapper.querySelector('input[type="number"]');

                if (this.checked) {
                    wrapper.style.display = 'block';
                    input.disabled = false;
                } else {
                    wrapper.style.display = 'none';
                    input.disabled = true;
                    input.value = ''; // kosongkan juga
                }
            });
        });

        // Hapus input jumlah dan checkbox obat jika jumlah kosong
        document.querySelector('form').addEventListener('submit', function(e) {
            document.querySelectorAll('.tanggal-lanjutan').forEach(input => {
                const anakId = input.dataset.anak;
                const kategori_imunisasi_id = input.dataset.kategori_imunisasi_id;
                const kategoriCheckboxes = document.querySelectorAll(
                    `input[name="kategori_imunisasi_id[${anakId}][${kategori_imunisasi_id}]"]`);
                const kategoriChecked = Array.from(kategoriCheckboxes).some(cb => cb.checked);
                if (!input.value || !kategoriChecked) {
                    input.name = ''; // Kosongkan name supaya tidak ikut terkirim
                }
            });
            document.querySelectorAll('input:disabled').forEach(input => input.remove());
        });
    </script>
@endpush
