@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-primary">
                    <i class="fas fa-baby-carriage me-1"></i> Detail Kehamilan
                </h5>
                <a href="{{ route('kehamilan.index') }}" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
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
                <h6 class="text-muted mb-3">Riwayat Pemeriksaan Kehamilan</h6>

                @if ($kehamilan->pemeriksaanKehamilans->isEmpty())
                    <div class="alert alert-info">Belum ada data pemeriksaan kehamilan.</div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Keluhan</th>
                                    <th scope="col">Tekanan Darah</th>
                                    <th scope="col">Berat Badan</th>
                                    <th scope="col">Posisi Janin</th>
                                    <th scope="col">Usia Kandungan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @foreach ($kehamilan->pemeriksaanKehamilans as $pemeriksaan)
                                    <tr>
                                        <td>{{ $pemeriksaan->tanggal_pemeriksaan_kehamilan }}
                                        </td>
                                        <td>{{ $pemeriksaan->deskripsi_pemeriksaan_kehamilan }}</td>
                                        <td>
                                            @if ($pemeriksaan->keluhan_kehamilan)
                                                <span
                                                    class=" badge bg-danger text-white">{{ $pemeriksaan->keluhan_kehamilan }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td><span
                                                class="badge bg-info text-white">{{ $pemeriksaan->tekanan_darah_ibu_hamil }}</span>
                                        </td>
                                        <td>{{ number_format($pemeriksaan->berat_badan_ibu_hamil, 1) }} kg</td>
                                        <td>{{ $pemeriksaan->posisi_janin }}</td>
                                        <td><span class="badge bg-warning text-white">{{ $pemeriksaan->usia_kandungan }}
                                                minggu</span></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
