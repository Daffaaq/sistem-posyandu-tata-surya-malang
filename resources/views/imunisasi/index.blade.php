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
                                <th>Action</th>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Imunisasi Anak</h6>
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

                    @foreach ($anaks as $anak)
                        <div class="anak-imunisasi-form" id="formAnak{{ $anak->id }}"
                            style="display: none; margin-top: 20px;">
                            <h5>Data Imunisasi untuk {{ $anak->nama_anak }}</h5>

                            @foreach ($kategoriImunisasi as $kategori)
                                <div class="card mb-2 p-3">
                                    <div class="form-check">
                                        <input class="form-check-input kategori-radio" type="radio"
                                            name="kategori_imunisasi_id[{{ $anak->id }}]" value="{{ $kategori->id }}"
                                            id="kategori{{ $anak->id }}_{{ $kategori->id }}"
                                            data-anak-id="{{ $anak->id }}">
                                        <label class="form-check-label"
                                            for="kategori{{ $anak->id }}_{{ $kategori->id }}">
                                            {{ $kategori->nama_kategori_imunisasi }}
                                        </label>
                                    </div>

                                    <div class="kategori-detail mt-2"
                                        id="kategoriDetail{{ $anak->id }}_{{ $kategori->id }}" style="display: none;">
                                        <div class="form-group">
                                            <label>Tanggal Imunisasi Lanjutan (Opsional)</label>
                                            <input type="date"
                                                name="tanggal_imunisasi_lanjutan[{{ $anak->id }}][{{ $kategori->id }}]"
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Obat (Opsional)</label>
                                            @foreach ($obats as $obat)
                                                <div class="form-check d-flex align-items-center mb-2">
                                                    <input class="form-check-input obat-checkbox" type="checkbox"
                                                        name="obat_id[{{ $anak->id }}][{{ $kategori->id }}][]"
                                                        value="{{ $obat->id }}"
                                                        id="obat{{ $anak->id }}_{{ $kategori->id }}_{{ $obat->id }}"
                                                        data-target="#jumlahObat{{ $anak->id }}_{{ $kategori->id }}_{{ $obat->id }}">
                                                    <label class="form-check-label me-2"
                                                        for="obat{{ $anak->id }}_{{ $kategori->id }}_{{ $obat->id }}">
                                                        {{ $obat->nama_obat_vitamin }} (Stok: {{ $obat->stok }})
                                                    </label>

                                                    <input type="number"
                                                        name="jumlah_obat[{{ $anak->id }}][{{ $kategori->id }}][{{ $obat->id }}]"
                                                        class="form-control" min="1"
                                                        style="width: 100px; display: none;"
                                                        id="jumlahObat{{ $anak->id }}_{{ $kategori->id }}_{{ $obat->id }}">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endforeach


                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Simpan Imunisasi</button>
                    </div>


                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Pemeriksaan Kehamilan</h5>
                    <button type="button" class="btn-close" id="closeModal" data-bs-dismiss="modal" aria-label="Close"><i
                            class="bi bi-x"></i></button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    },
                    {
                        data: 'id',
                        name: 'id',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let editImunisasi = `/imunisasi/${data}/edit`;
                            return `<a href="${editImunisasi}" class="btn btn-primary btn-sm">Edit</a>
                            <button class="btn btn-info btn-sm" onclick="openModal(${data})">Lihat</button>`;
                        }
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

        function openModal(id) {
            $.ajax({
                url: '{{ route('imunisasi.obat-modal', ':id') }}'.replace(':id', id),
                type: 'GET',
                data: {
                    id: id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        const data = response.data;

                        let modalContent = `
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Obat/Vitamin</th>
                                <th>Tipe</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                        data.forEach((item, index) => {
                            modalContent += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${item.obat.nama_obat_vitamin}</td>
                            <td>${item.obat.tipe}</td>
                            <td>${item.obat.deskripsi}</td>
                            <td>${item.jumlah_obat}</td>
                        </tr>
                    `;
                        });

                        modalContent += `
                        </tbody>
                    </table>
                `;

                        $('#modalContent').html(modalContent);
                        $('#detailModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'info',
                            title: 'Tidak Ada Data',
                            text: 'Data obat untuk imunisasi ini tidak ditemukan.'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memuat Data',
                        text: 'Terjadi kesalahan saat mengambil data dari server.'
                    });
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
        document.querySelectorAll('.anak-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const anakId = this.value;
                const formSection = document.getElementById(`formAnak${anakId}`);
                formSection.style.display = this.checked ? 'block' : 'none';
            });
        });

        document.querySelectorAll('.kategori-radio').forEach(rb => {
            rb.addEventListener('change', function() {
                const anakId = this.dataset.anakId;

                // Sembunyikan semua kategori detail untuk anak tersebut
                document.querySelectorAll(`[id^="kategoriDetail${anakId}_"]`).forEach(el => {
                    el.style.display = 'none';
                });

                // Tampilkan hanya kategori terpilih
                const detailId = `kategoriDetail${anakId}_${this.value}`;
                const detailEl = document.getElementById(detailId);
                if (detailEl) {
                    detailEl.style.display = 'block';
                }
            });
        });


        document.querySelectorAll('.obat-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const target = document.querySelector(this.dataset.target);
                if (target) {
                    target.style.display = this.checked ? 'inline-block' : 'none';
                    if (!this.checked) target.value = ''; // clear jika uncheck
                }
            });
        });
    </script>
@endpush
