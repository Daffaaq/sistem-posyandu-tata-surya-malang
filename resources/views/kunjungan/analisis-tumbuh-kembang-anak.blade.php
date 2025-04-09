@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Card Pemantauan Tumbuh Kembang Anak -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Pemantauan Tumbuh Kembang Anak</h6>
            </div>
            <div class="card-body">
                <!-- Tabel Pemantauan Tumbuh Kembang Anak -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="PemantauanTumbuhKembangAnakTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>Tinggi Badan (cm)</th>
                                <th>Berat Badan (kg)</th>
                                <th>Perkembangan Motorik</th>
                                <th>Perkembangan Psikis</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Card Kunjungan Obat -->
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Kunjungan Obat</h6>
            </div>
            <div class="card-body">
                <!-- Tabel Kunjungan Obat -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="KunjunganObatTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Jumlah Obat</th>
                                <th>nama_anak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimuat melalui DataTables -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Anak</h6>
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
                <h6 class="m-0 font-weight-bold text-primary">Form Pemantauan Tumbuh Kembang Anak</h6>
            </div>
            <div class="card-body">
                <!-- Form untuk menambahkan Pemantauan Tumbuh Kembang Anak -->
                <form method="POST" action="{{ route('kunjungan.pantauan-tumbuh-kembang-anak-store', $kunjungan->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Pilih Anak -->
                    <div class="form-group">
                        <label for="anak_id">Pilih Anak</label>
                        <div id="anak-checkboxes" class="d-flex flex-wrap">
                            @foreach ($anak as $item)
                                <div class="form-check mr-3 mb-2">
                                    <input class="form-check-input" type="checkbox" value="{{ $item->id }}"
                                        name="anak_id[]" id="anak_{{ $item->id }}">
                                    <label class="form-check-label" for="anak_{{ $item->id }}">
                                        {{ $item->nama_anak }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Container untuk form anak dan obat dinamis -->
                    <div id="children-fields">
                        <!-- Form anak dan obat dinamis akan ditambahkan di sini -->
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Data</button>
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
        $(document).ready(function() {
            var kunjunganId = {{ $kunjungan->id }}; // ID Kunjungan

            // DataTables for Pemantauan Tumbuh Kembang Anak
            $('#PemantauanTumbuhKembangAnakTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kunjungan.list-pemantauan-tumbuh-kembang-anak', ':id') }}'.replace(
                        ':id', kunjunganId),
                    type: 'POST',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                    },
                    dataSrc: function(json) {
                        console.log(json); // Menambahkan log untuk memeriksa data
                        return json.data;
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kunjungan_anak.anak.nama_anak',
                        name: 'kunjungan_anak.anak.nama_anak'
                    },
                    {
                        data: 'tinggi_badan',
                        name: 'tinggi_badan'
                    },
                    {
                        data: 'berat_badan',
                        name: 'berat_badan'
                    },
                    {
                        data: 'perkembangan_motorik',
                        name: 'perkembangan_motorik'
                    },
                    {
                        data: 'perkembangan_psikis',
                        name: 'perkembangan_psikis'
                    },
                ]
            });

            // DataTables for Kunjungan Obat
            $('#KunjunganObatTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('kunjungan.list-data-obat-kunjungan', ':id') }}'.replace(':id',
                        kunjunganId),
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
                        data: 'nama_obat_vitamin',
                        name: 'nama_obat_vitamin'
                    },
                    {
                        data: 'jumlah_obat',
                        name: 'jumlah_obat'
                    },
                    {
                        data: 'nama_anak',
                        name: 'nama_anak'
                    },
                ]
            });

            // Display success message if available
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: '{{ session('success') }}',
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            @endif
        });

        $(document).ready(function() {
            var obatData = @json($obat); // Menyertakan data obat dari server
            // Fungsi untuk memperbarui form anak dan obat
            function updateFields() {
                const selectedChildren = $('input[name="anak_id[]"]:checked');

                // Menghapus field anak dan obat sebelumnya
                $('#children-fields').empty();

                selectedChildren.each(function(index) {
                    const anakId = $(this).val();
                    const anakName = $(this).next('label').text();

                    // Menambahkan form untuk data anak
                    const childFields = `
                <div class="child-fields" data-anak-id="${anakId}">
                    <h5>Form untuk Anak ${anakName}</h5>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="tinggi_badan_${anakId}">Tinggi Badan (cm)</label>
                            <input type="number" class="form-control" id="tinggi_badan_${anakId}" name="tinggi_badan[]" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="berat_badan_${anakId}">Berat Badan (kg)</label>
                            <input type="number" class="form-control" id="berat_badan_${anakId}" name="berat_badan[]" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="perkembangan_motorik_${anakId}">Perkembangan Motorik</label>
                        <input type="text" class="form-control" id="perkembangan_motorik_${anakId}" name="perkembangan_motorik[]" required>
                    </div>

                    <div class="form-group">
                        <label for="perkembangan_psikis_${anakId}">Perkembangan Psikis</label>
                        <input type="text" class="form-control" id="perkembangan_psikis_${anakId}" name="perkembangan_psikis[]" required>
                    </div>
                </div>
            `;
                    // Menambahkan form anak ke container
                    $('#children-fields').append(childFields);

                    // Menambahkan pembatas setelah form anak
                    $('#children-fields').append('<hr>');

                    // Menambahkan form obat untuk setiap anak
                    const medicationForm = `
                <div class="medication-form" data-anak-id="${anakId}">
                    <h5>Obat untuk Anak ${anakName}</h5>
                    
                    <div class="form-group">
                        <label for="obat_id_${anakId}">Pilih Obat</label>
                        <div id="obat_id_${anakId}" class="checkbox-group">
                            ${obatData.map(item => `
                                                                            <div class="form-check">
                                                                                <input class="form-check-input" type="checkbox" value="${item.id}" name="obat_id[${anakId}][]" id="obat_${item.id}">
                                                                                <label class="form-check-label" for="obat_${item.id}">
                                                                                    ${item.nama_obat_vitamin}
                                                                                </label>

                                                                                <!-- Input untuk jumlah obat (saat obat dipilih) -->
                                                                                <div id="jumlah_obat_${anakId}_${item.id}" class="jumlah-obat" style="display:none;">
                                                                                    <label for="jumlah_obat_${anakId}_${item.id}">Jumlah Obat</label>
                                                                                    <input type="number" class="form-control" name="jumlah_obat[${anakId}][${item.id}]" id="jumlah_obat_${anakId}_${item.id}" min="1">
                                                                                </div>
                                                                            </div>
                                                                        `).join('')}
                        </div>
                    </div>
                </div>
            `;
                    // Menambahkan form obat ke container
                    $('#children-fields').append(medicationForm);

                    // Menambahkan pembatas setelah form obat anak
                    $('#children-fields').append('<hr>');
                });
            }

            // Event listener untuk checkbox anak
            $('#anak-checkboxes').on('change', 'input[type="checkbox"]', function() {
                updateFields();
            });

            // Event listener untuk checkbox obat (menampilkan input jumlah obat)
            $(document).on('change', '.form-check-input', function() {
                const anakId = $(this).closest('.medication-form').data('anak-id');
                const obatId = $(this).val();
                const jumlahObatField = $(`#jumlah_obat_${anakId}_${obatId}`);

                // Jika checkbox di-check, tampilkan input jumlah obat
                if ($(this).is(':checked')) {
                    jumlahObatField.show();
                } else {
                    jumlahObatField.hide();
                    $(`#jumlah_obat_${anakId}_${obatId}`).val(''); // Clear the value if unchecked
                }
            });
        });
    </script>
@endpush
