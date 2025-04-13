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
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables akan mengisi ini -->
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
                    }
                ]
            });
        });
    </script>
@endpush
