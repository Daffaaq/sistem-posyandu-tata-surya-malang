@extends('layouts.app')
@section('content')
    @hasanyrole('super-admin|admin|petugas')
        <div class="container-fluid">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Dashboard Management</h6>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">User
                                Dashboard</a>
                        </li>
                    </ol>
                </div>
                <div class="card-body">
                    <!-- Baris 1 -->
                    <h6 class="text-gray-800 font-weight-bold mb-3">Parent & Child Statistics</h6>
                    <div class="row">
                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-primary shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Parents</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalOrangTua }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-success shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Parents</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalOrangTuaAktif }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-warning shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Pregnant</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalIbuHamil }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-danger shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Children</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalAnak }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <!-- Baris 2 -->
                    <h6 class="text-gray-800 font-weight-bold mt-4 mb-3">Drug & Vitamin Stock</h6>
                    <div class="row">
                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-primary shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Drugs & Vitamins
                                    </div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalObat }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-success shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Available Stock</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalBelumKadaluarsa }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-warning shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Expired Stock</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalKadaluarsaBelumArsip }}</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-6 col-md-3 mb-2">
                            <div class="card border-left-danger shadow-sm py-1 px-2">
                                <div class="card-body p-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Archived Items</div>
                                    <div class="small font-weight-bold text-gray-800">{{ $totalSudahArsip }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endhasanyrole
    @role('orang-tua')
        <div class="container-fluid">
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-header py-4 bg-white d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="m-0 font-weight-bold text-dark">
                        Halo, Bunda {{ Auth::user()->name }} 👋
                    </h5>
                    <p class="mb-0 text-muted small">Selamat datang kembali! Ini informasi terbaru tentang anak Anda.</p>
                </div>

                <div class="card-body p-4">
                    <!-- Informasi Anak -->
                    <h6 class="text-dark font-weight-bold mb-4">Informasi Anak</h6>

                    @if ($anaks->isEmpty() && $kehamilan)
                        @if ($kehamilan->status_kehamilan == 'Hamil')
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-baby-carriage text-info me-2"></i>
                                <span>
                                    Anda sedang {{ $kehamilan->status_kehamilan }} dengan prediksi tanggal lahir pada
                                    {{ \Carbon\Carbon::parse($kehamilan->prediksi_tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}.
                                </span>
                            </div>
                        @elseif ($kehamilan->status_kehamilan == 'Melahirkan')
                            <div class="alert alert-success d-flex align-items-center">
                                <i class="fas fa-gift text-success mr-2"></i>
                                <span>
                                    Proses kehamilan Anda telah selesai, selamat! Anak Anda telah lahir pada
                                    {{ \Carbon\Carbon::parse($kehamilan->tanggal_mulai_kehamilan)->locale('id')->translatedFormat('d F Y') }}.
                                </span>
                            </div>
                        @elseif ($kehamilan->status_kehamilan == 'Gugur')
                            <div class="alert alert-danger d-flex align-items-center">
                                <i class="fas fa-heart-broken text-danger mr-2"></i>
                                <span>
                                    Kami sangat menyesal, Anda mengalami keguguran pada
                                    {{ \Carbon\Carbon::parse($kehamilan->tanggal_mulai_kehamilan)->locale('id')->translatedFormat('d F Y') }}.
                                    Kami berharap Anda segera diberi kekuatan.
                                </span>
                            </div>
                        @endif
                    @elseif ($anaks->isEmpty() && !$kehamilan)
                        <div class="alert alert-light border-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-warning mr-2"></i>
                            <span>Anda belum memiliki anak dan tidak sedang hamil.</span>
                        </div>
                    @elseif ($anaks->isNotEmpty())
                        @if ($kehamilan)
                            @if ($kehamilan->status_kehamilan == 'Hamil')
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="fas fa-baby-carriage text-info mr-2"></i>
                                    <span>
                                        Anda sedang {{ $kehamilan->status_kehamilan }} dengan prediksi tanggal lahir pada
                                        {{ \Carbon\Carbon::parse($kehamilan->prediksi_tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}.
                                    </span>
                                </div>
                            @elseif ($kehamilan->status_kehamilan == 'Melahirkan')
                                <div class="alert alert-success d-flex align-items-center">
                                    <i class="fas fa-gift text-success mr-2"></i>
                                    <span>
                                        Proses kehamilan Anda telah selesai, selamat! Anak Anda telah lahir pada
                                        {{ \Carbon\Carbon::parse($kehamilan->tanggal_mulai_kehamilan)->locale('id')->translatedFormat('d F Y') }}.
                                    </span>
                                </div>
                            @elseif ($kehamilan->status_kehamilan == 'Gugur')
                                <div class="alert alert-danger d-flex align-items-center">
                                    <i class="fas fa-heart-broken text-danger mr-2"></i>
                                    <span>
                                        Kami sangat menyesal, Anda mengalami keguguran pada
                                        {{ \Carbon\Carbon::parse($kehamilan->tanggal_mulai_kehamilan)->locale('id')->translatedFormat('d F Y') }}.
                                        Kami berharap Anda segera diberi kekuatan.
                                    </span>
                                </div>
                            @endif
                        @endif

                        <div class="row">
                            @foreach ($anaks as $index => $anak)
                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div class="card-body p-3">
                                            <h6 class="font-weight-bold text-dark">Nama Anak</h6>
                                            <p class="mb-0 text-muted">{{ $anak->nama_anak }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div class="card-body p-3">
                                            <h6 class="font-weight-bold text-dark">Tanggal Lahir</h6>
                                            <p class="mb-0 text-muted">
                                                {{ \Carbon\Carbon::parse($anak->tanggal_lahir_anak)->format('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="card shadow-sm border-0 rounded-3">
                                        <div class="card-body p-3">
                                            <h6 class="font-weight-bold text-dark">Usia Saat Ini</h6>
                                            <p class="mb-0 text-muted">{{ $usiaAnaks[$index] }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <!-- Jadwal -->
                    <h6 class="text-dark font-weight-bold mt-4 mb-3">Jadwal & Pengingat</h6>

                    @isset($jadwalTerdekat)
                        <div class="alert alert-light border-info d-flex align-items-center">
                            <i class="fas fa-calendar-alt text-info mr-2"></i>
                            <span>
                                {{ $jadwalTerdekat->nama_kegiatan }} dijadwalkan pada
                                {{ \Carbon\Carbon::parse($jadwalTerdekat->tanggal_kegiatan)->locale('id')->translatedFormat('d F Y') }}
                                pukul {{ \Carbon\Carbon::parse($jadwalTerdekat->waktu_kegiatan)->format('H:i') }}
                                di {{ $jadwalTerdekat->tempat_kegiatan }}.
                            </span>
                        </div>
                    @else
                        <div class="alert alert-light border-warning d-flex align-items-center">
                            <i class="fas fa-exclamation-circle text-warning me-2"></i>
                            <span>Saat ini tidak ada jadwal kegiatan posyandu yang tersedia.</span>
                        </div>
                    @endisset
                </div>

            </div>

        </div>
    @endrole
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
