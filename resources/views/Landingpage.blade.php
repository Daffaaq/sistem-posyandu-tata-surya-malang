<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>

    <!-- Include CSRF meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Custom Script -->
    <script src="{{ asset('Landing/js/datatables-obat.js') }}"></script>

    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById('menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');

            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('data-target');
                    const targetEl = document.getElementById(targetId);

                    if (targetEl) {
                        targetEl.scrollIntoView({
                            behavior: 'smooth'
                        });

                        // Hapus hash dari URL jika ada
                        history.replaceState(null, null, ' ');
                    }
                });
            });
        });
    </script>
</head>

<body>
    <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="text-xl font-bold text-green-600">
                Posyandu Tata Surya <span class="text-gray-800">Malang</span>
            </div>

            <!-- Desktop Menu -->
            <nav class="hidden md:flex space-x-6 items-center">
                <a href="#" class="nav-link text-gray-700 hover:text-green-600 transition duration-300"
                    data-target="home">Beranda</a>
                <a href="#" class="nav-link text-gray-700 hover:text-green-600 transition duration-300"
                    data-target="about">Tentang</a>
                <a href="#" class="nav-link text-gray-700 hover:text-green-600 transition duration-300"
                    data-target="features">Fitur</a>
                <a href="#" class="nav-link text-gray-700 hover:text-green-600 transition duration-300"
                    data-target="blog">Blog</a>

                <div class="relative inline-block text-left">
                    <button id="dropdownButton"
                        class="flex items-center space-x-1 text-gray-700 hover:text-green-600 focus:outline-none">
                        <span>Menu</span>
                        <svg class="w-4 h-4 transition-transform duration-300" id="chevronIcon"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div id="dropdownMenu" class="absolute left-0 hidden bg-white shadow-lg rounded-lg mt-2 w-40 z-10">
                        <a href="#"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded-t-lg transition duration-300">Jadwal
                            Posyandu</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50 transition duration-300">Panduan</a>
                        <a href="#"
                            class="block px-4 py-2 text-gray-700 hover:bg-green-50 rounded-b-lg transition duration-300">FAQ</a>
                    </div>
                </div>




                <a href="#" class="nav-link text-gray-700 hover:text-green-600 transition duration-300"
                    data-target="contact">Kontak</a>

            </nav>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="menu-toggle" class="text-gray-700 focus:outline-none">
                    ☰
                </button>
            </div>
        </div>

        <!-- Mobile Menu (hidden by default) -->
        <div id="mobile-menu" class="md:hidden hidden px-4 pb-4 bg-white">
            <a href="#home" class="block py-2 text-gray-700 hover:text-green-600">Beranda</a>
            <a href="#about" class="block py-2 text-gray-700 hover:text-green-600">Tentang</a>
            <a href="#features" class="block py-2 text-gray-700 hover:text-green-600">Fitur</a>
            <a href="#blog" class="block py-2 text-gray-700 hover:text-green-600">Blog</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-green-600">Jadwal Posyandu</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-green-600">Panduan</a>
            <a href="#" class="block py-2 text-gray-700 hover:text-green-600">FAQ</a>
            <a href="#contact" class="block py-2 text-gray-700 hover:text-green-600">Kontak</a>
        </div>
    </header>



    <!-- Hero Section -->
    <section id="home" class="pt-24 bg-green-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col-reverse lg:flex-row items-center justify-between">

            <!-- Text Content -->
            <div class="w-full lg:w-1/2 text-center lg:text-left space-y-6">
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-800 leading-tight">
                    Posyandu Tata Surya <span class="text-green-600">Malang</span>
                </h1>
                <p class="text-gray-600 text-lg">
                    Satu platform untuk data balita, imunisasi, dan kesehatan yang lebih terorganisir.
                </p>
                <div class="flex justify-center lg:justify-start gap-4">
                    <a href="#"
                        class=" nav-link px-6 py-3 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition"
                        data-target="features">
                        Lihat Fitur
                    </a>
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-white border border-green-600 text-green-600 rounded-full font-semibold hover:bg-green-50 transition">
                        Yuk Mulai!
                    </a>
                </div>
            </div>

            <!-- Image / Illustration -->
            <div class="w-full lg:w-1/2 mb-10 lg:mb-0">
                <img src="https://img.freepik.com/free-photo/medical-teleconsultation-sick-patient-home_23-2149329021.jpg?t=st=1745064159~exp=1745067759~hmac=c5471e33ea703313f4949fc1f403ba2bacc482d90912c502226581bc1771556c&w=1380"
                    alt="Ilustrasi Posyandu" class="w-full max-w-md mx-auto">
            </div>

        </div>
    </section>


    <!-- Tentang Sistem -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 space-y-24">

            <!-- Blok 1 -->
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <!-- Gambar -->
                <div class="w-full lg:w-1/2">
                    <img src="https://img.freepik.com/free-photo/medical-doctor-holding-tablet_23-2149611236.jpg?t=st=1745065396~exp=1745068996~hmac=f57ab67ba3430b4025ce34479ed78ca128f23323d56220e3c2ab391ae3613164&w=1380"
                        alt="Ilustrasi Posyandu Tata Surya Malang" class="w-full max-w-lg mx-auto rounded-lg shadow-md">
                </div>

                <!-- Teks -->
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Itu Sistem Posyandu Tata Surya Malang?</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Sistem ini dirancang untuk memudahkan warga Komplek Perumahan Tata Surya Malang dalam mengelola
                        kesehatan balita, imunisasi, keluarga berencana, dan jadwal posyandu secara digital dan efisien.
                    </p>
                    <ul class="space-y-4 text-gray-700 list-inside">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Dashboard real-time untuk memantau kesehatan balita dan stok secara langsung</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Pencatatan kunjungan balita dan imunisasi yang terorganisir dengan baik</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Informasi keluarga berencana yang dapat diakses oleh orang tua</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Jadwal posyandu yang terintegrasi dan mudah diakses oleh masyarakat</span>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Blok 2 -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                <!-- Gambar -->
                <div class="w-full lg:w-1/2">
                    <img src="https://img.freepik.com/free-photo/medical-examination-report-history-history_53876-132763.jpg?t=st=1745065633~exp=1745069233~hmac=150db422dcd88ded5dc83a19065dbe14ab81f22af6485ca9e13078928c87dcb8&w=1480"
                        alt="Ilustrasi Penggunaan Sistem" class="w-full max-w-md mx-auto rounded-lg shadow-md">
                </div>

                <!-- Teks -->
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Kenapa Harus Pakai Sistem Ini?</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Sistem ini dirancang untuk meningkatkan efisiensi posyandu dengan pendekatan digital yang
                        sederhana dan mudah digunakan oleh semua kalangan.
                    </p>
                    <ul class="space-y-3 text-gray-700">
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Antarmuka ramah pengguna, mudah dipahami oleh siapa saja</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Akses dari perangkat apa saja, baik HP maupun Laptop</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-600">✔️</span>
                            <span>Cetak laporan kesehatan kapan saja dengan mudah</span>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </section>

    <!-- Fitur Unggulan (Versi Baru) -->
    <section id="features" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="mb-16 text-center">
                <h2 class="text-4xl font-bold text-gray-800 mb-4">Fitur Unggulan Sistem</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                    Semua fitur kami dirancang khusus untuk mendukung kegiatan Posyandu yang efisien, akurat, dan mudah
                    digunakan siapa saja.
                </p>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

                <!-- Card 1 -->
                <div class="flex flex-col items-start space-y-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <!-- Heroicon: Clipboard List -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5h6M9 3h6a2 2 0 012 2v0a2 2 0 01-2 2H9a2 2 0 01-2-2v0a2 2 0 012-2zM4 7h16v13a2 2 0 01-2 2H6a2 2 0 01-2-2V7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Pencatatan Balita</h3>
                    <p class="text-gray-600">
                        Input data berat badan, tinggi, status imunisasi secara digital dan terstruktur.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="flex flex-col items-start space-y-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <!-- Heroicon: Calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7H3v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Jadwal Imunisasi</h3>
                    <p class="text-gray-600">
                        Sistem otomatis mengatur dan mengingatkan jadwal imunisasi sesuai umur balita.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="flex flex-col items-start space-y-4">
                    <div class="bg-green-100 p-3 rounded-full">
                        <!-- Heroicon: Cube -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 7l-8 4.5L4 7m16 0v7l-8 4.5m8-4.5L12 17m0 0L4 14m8 3v-7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800">Stok Vitamin & Obat</h3>
                    <p class="text-gray-600">
                        Kelola persediaan vitamin, tambah stok, dan pantau distribusi harian.
                    </p>
                </div>

            </div>
        </div>
    </section>



    <!-- Blog Section -->
    <section id="blog" class="py-24 bg-green-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Artikel & Tips Posyandu</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto mt-2">
                    Update informasi terbaru seputar kesehatan anak, imunisasi, hingga tips pengelolaan Posyandu.
                </p>
            </div>

            <!-- Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                <!-- Blog Card 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                    <img src="https://img.freepik.com/free-photo/baby-with-stuffed-animal_52683-124509.jpg?t=st=1745063533~exp=1745067133~hmac=2ed5bde27d6b1cce0b9552f5090d28c8c8624163dc3343c3feee68aa337a6010&w=1380"
                        alt="Blog 1" class="w-full h-52 object-cover">
                    <div class="p-5">
                        <span class="text-sm text-green-600 font-medium uppercase">Tips Imunisasi</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-2 mb-2">Kapan Jadwal Imunisasi yang Tepat?
                        </h3>
                        <p class="text-gray-600 text-sm">
                            Imunisasi harus dilakukan sesuai usia bayi. Berikut panduan lengkapnya untuk kader dan orang
                            tua.
                        </p>
                    </div>
                </div>

                <!-- Blog Card 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                    <img src="https://img.freepik.com/free-photo/group-kids-friends-arm-around-sitting-together_1150-3907.jpg?t=st=1745063903~exp=1745067503~hmac=1864025edc946ad0f5a6a050edb50f1fb3a70f8e31b81166918f3d5c06e1c034&w=1380"
                        alt="Blog 2" class="w-full h-52 object-cover">
                    <div class="p-5">
                        <span class="text-sm text-green-600 font-medium uppercase">Kesehatan Anak</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-2 mb-2">Vitamin Penting untuk Balita</h3>
                        <p class="text-gray-600 text-sm">
                            Apa saja vitamin yang wajib ada di posyandu? Yuk kenali kebutuhan gizi anak usia dini!
                        </p>
                    </div>
                </div>

                <!-- Blog Card 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition">
                    <img src="https://img.freepik.com/free-photo/creative-collage-telehealth-consultation_23-2149488756.jpg?t=st=1745063959~exp=1745067559~hmac=b294ceb028cf0dbc85894d183cf3d7b7216343f955a29bb64955110c9ac7dc73&w=1380"
                        alt="Blog 3" class="w-full h-52 object-cover">
                    <div class="p-5">
                        <span class="text-sm text-green-600 font-medium uppercase">Digitalisasi</span>
                        <h3 class="text-xl font-semibold text-gray-800 mt-2 mb-2">Posyandu Go Digital</h3>
                        <p class="text-gray-600 text-sm">
                            Di era digital, posyandu bisa lebih efisien dengan sistem pencatatan dan pelaporan berbasis
                            web.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- Section Obat / Vitamin -->
    <section id="obat-vitamin" class="pt-24 bg-white pb-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Obat & Vitamin Posyandu</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto mt-2">
                    Data obat dan vitamin yang tersedia di posyandu, termasuk stok dan tanggal kedaluwarsa.
                </p>
            </div>

            <!-- Filter -->
            <div class="mb-4">
                <label for="tipe_filter" class="block mb-2 text-gray-700 font-semibold">Filter Tipe:</label>
                <select id="tipe_filter" class="border border-gray-300 rounded px-4 py-2">
                    <option value="">Semua</option>
                    <option value="obat">Obat</option>
                    <option value="vitamin">Vitamin</option>
                </select>
            </div>

            <!-- Legend / Keterangan Indikator -->
            <div class="mb-6 flex flex-wrap items-center gap-6 text-sm text-gray-700">
                <div class="flex items-center gap-2">
                    <span class="inline-block w-3 h-3 rounded-full bg-red-500"></span>
                    <span>Stok sangat rendah dan kadaluarsa dalam 7 hari</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-3 h-3 rounded-full bg-yellow-400"></span>
                    <span>Kadaluarsa mendekati (8–14 hari)</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="inline-block w-3 h-3 rounded-full bg-green-500"></span>
                    <span>Kadaluarsa masih aman (>14 hari)</span>
                </div>
            </div>
            <!-- Tabel Data Obat -->
            <div class="overflow-x-auto bg-white p-4 rounded-lg shadow-md">
                <table id="tableObat" class="min-w-full divide-y divide-gray-200 text-sm text-gray-700">
                    <thead class="bg-green-100 text-gray-700 uppercase tracking-wider text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">Nama</th>
                            <th class="px-4 py-3 text-left">Tipe</th>
                            <th class="px-4 py-3 text-left">Stok</th>
                            <th class="px-4 py-3 text-left">Kadaluarsa</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        <!-- DataTables akan isi ini -->
                    </tbody>
                </table>
            </div>

        </div>
    </section>


    <!-- Section Jadwal Posyandu -->
    <section id="jadwal-posyandu" class="pt-24 bg-green-50 pb-10">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="mb-12 text-center">
                <h2 class="text-3xl font-bold text-gray-800">Jadwal Posyandu</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto mt-2">
                    Informasi jadwal kegiatan posyandu yang akan datang, termasuk waktu dan tempat kegiatan.
                </p>
            </div>

            <!-- Timeline Jadwal -->
            <div class="space-y-12">
                @foreach ($jadwals as $index => $jadwal)
                    <div class="flex items-center {{ $index % 2 == 0 ? 'flex-row' : 'flex-row-reverse' }} mb-8">
                        <div class="w-1/3 flex justify-center">
                            <!-- Icon Bulat untuk Status Waktu Kegiatan -->
                            @php
                                $today = \Carbon\Carbon::now();
                                $jadwalDate = \Carbon\Carbon::parse($jadwal->tanggal_kegiatan);
                                $diffInDays = $today->diffInDays($jadwalDate, false);
                            @endphp

                            <!-- Warna Bulatan Berdasarkan Status Tanggal -->
                            <div
                                class="w-10 h-10 rounded-full 
                        {{ $diffInDays <= 7 ? 'bg-red-600' : ($diffInDays <= 14 ? 'bg-yellow-500' : 'bg-green-600') }} 
                        text-white flex items-center justify-center shadow-lg transform transition duration-300 hover:scale-110">
                                <span class="text-xs font-bold">
                                    @if ($diffInDays <= 7)
                                        🔴
                                    @elseif ($diffInDays <= 14)
                                        🟡
                                    @else
                                        🟢
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div
                            class="w-2/3 {{ $index % 2 == 0 ? 'pl-8' : 'pr-8' }} p-6 rounded-lg shadow-xl hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105
                        {{ $diffInDays <= 7 ? 'bg-gray-800' : ($diffInDays <= 14 ? 'bg-gray-800' : 'bg-gray-800') }}">
                            <h3 class="text-xl font-semibold text-white">{{ $jadwal->nama_kegiatan }}</h3>
                            <p class="text-white mt-2">
                                <strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($jadwal->tanggal_kegiatan)->format('d-m-Y') }}
                            </p>
                            <p class="text-white">
                                <strong>Waktu:</strong>
                                {{ \Carbon\Carbon::parse($jadwal->waktu_kegiatan)->format('H:i') }}
                            </p>
                            <p class="text-white">
                                <strong>Tempat:</strong> {{ $jadwal->tempat_kegiatan }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="contact" class="py-24 bg-gradient-to-r from-green-600 to-teal-500 text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold mb-4">Hubungi Kami</h2>
                <p class="text-lg max-w-2xl mx-auto">
                    Kami senang mendengar masukan Anda! Jika ada pertanyaan atau ingin berdiskusi lebih lanjut, jangan
                    ragu untuk menghubungi kami.
                </p>
            </div>

            <!-- Kontak Form & Info -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Form Kontak -->
                <div class="bg-white p-8 rounded-2xl shadow-xl">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Kirim Pesan</h3>

                    <form action="#" method="POST" class="space-y-6">
                        <div class="flex gap-6">
                            <div class="w-full">
                                <label for="name" class="block text-gray-700 font-medium">Nama</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-6 py-3 border rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                            <div class="w-full">
                                <label for="email" class="block text-gray-700 font-medium">Email</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-6 py-3 border rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600">
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-gray-700 font-medium">Pesan</label>
                            <textarea id="message" name="message" rows="4" required
                                class="w-full px-6 py-3 border rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-green-600"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition">
                            Kirim Pesan
                        </button>
                    </form>
                </div>

                <!-- Info Kontak & Sosial Media -->
                <div class="space-y-8 lg:space-y-12">
                    <!-- Kontak Langsung -->
                    <div class="text-center lg:text-left">
                        <h3 class="text-2xl font-semibold text-white mb-4">Kontak Langsung</h3>
                        <p class="text-lg text-gray-300 mb-6 max-w-2xl mx-auto lg:mx-0">
                            Kami senang berbicara dengan Anda! Hubungi kami melalui sosial media atau email:
                        </p>
                        <div
                            class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-6 gap-6 justify-center lg:justify-start">
                            <!-- Icon Sosial Media -->
                            <a href="https://facebook.com" target="_blank"
                                class="text-gray-200 hover:text-blue-600 transition">
                                <i class="fab fa-facebook-f text-2xl"></i>
                            </a>
                            <a href="https://instagram.com" target="_blank"
                                class="text-gray-200 hover:text-pink-600 transition">
                                <i class="fab fa-instagram text-2xl"></i>
                            </a>
                            <a href="https://twitter.com" target="_blank"
                                class="text-gray-200 hover:text-blue-400 transition">
                                <i class="fab fa-twitter text-2xl"></i>
                            </a>
                            <a href="https://tiktok.com" target="_blank"
                                class="text-gray-200 hover:text-black transition">
                                <i class="fab fa-tiktok text-2xl"></i>
                            </a>
                            <a href="https://youtube.com" target="_blank"
                                class="text-gray-200 hover:text-red-600 transition">
                                <i class="fab fa-youtube text-2xl"></i>
                            </a>
                            <a href="https://linkedin.com" target="_blank"
                                class="text-gray-200 hover:text-blue-700 transition">
                                <i class="fab fa-linkedin-in text-2xl"></i>
                            </a>
                            <a href="https://wa.me" target="_blank"
                                class="text-gray-200 hover:text-green-600 transition">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </a>
                            <a href="https://telegram.org" target="_blank"
                                class="text-gray-200 hover:text-blue-500 transition">
                                <i class="fab fa-telegram-plane text-2xl"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Alamat Posyandu -->
                    <div class="bg-gray-800 p-8 rounded-lg shadow-lg mx-auto lg:max-w-4xl">
                        <h3 class="text-2xl font-semibold text-white mb-6 text-center lg:text-left">Alamat Posyandu
                        </h3>
                        <div class="flex items-center justify-center lg:justify-start text-gray-200 space-x-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 3c1.104 0 2 .896 2 2v14c0 1.104-.896 2-2 2H8c-1.104 0-2-.896-2-2V5c0-1.104.896-2 2-2h8zm0 2H8v14h8V5z" />
                            </svg>
                            <p class="text-lg text-gray-200">Posyandu Kesehatan Sehat, Jl. Sehat No. 123, RT 04, RW 02,
                                Kota Sehat, 12345</p>
                        </div>
                    </div>
                </div>




            </div>

        </div>
    </section>



    <!-- Footer Section -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 mb-10">

                <!-- Kolom 1: About -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Tentang Kami</h3>
                    <p class="text-gray-400 text-sm">
                        Posyandu Sehat adalah platform berbasis digital yang mendukung para kader kesehatan dalam
                        meningkatkan layanan posyandu kepada masyarakat.
                    </p>
                </div>

                <!-- Kolom 2: Link -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Link Cepat</h3>
                    <ul>
                        <li><a href="#home" class="text-gray-400 hover:text-white transition">Beranda</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition">Tentang</a></li>
                        <li><a href="#features" class="text-gray-400 hover:text-white transition">Fitur</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition">Kontak</a></li>
                    </ul>
                </div>

                <!-- Kolom 3: Sosial Media -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-6 justify-center lg:justify-start">
                        <!-- Ikon Sosial Media -->
                        <a href="https://facebook.com" target="_blank"
                            class="text-gray-400 hover:text-blue-600 transition">
                            <i class="fab fa-facebook-f text-2xl"></i>
                        </a>
                        <a href="https://instagram.com" target="_blank"
                            class="text-gray-400 hover:text-pink-600 transition">
                            <i class="fab fa-instagram text-2xl"></i>
                        </a>
                        <a href="https://twitter.com" target="_blank"
                            class="text-gray-400 hover:text-blue-400 transition">
                            <i class="fab fa-twitter text-2xl"></i>
                        </a>
                    </div>
                </div>


                <!-- Kolom 4: Alamat -->
                <div>
                    <h3 class="text-xl font-semibold mb-4">Alamat</h3>
                    <p class="text-gray-400 text-sm">
                        Posyandu Sehat, Jl. Sehat No. 123, RT 04, RW 02, Kota Sehat, 12345
                    </p>
                </div>
            </div>

            <div class="border-t border-gray-600 pt-6 mt-12">
                <p class="text-center text-gray-400 text-sm">
                    &copy; 2025 Posyandu Sehat. All Rights Reserved.
                </p>
            </div>

        </div>
    </footer>

    <script>
        const dropdownBtn = document.getElementById('dropdownButton');
        const dropdownMenu = document.getElementById('dropdownMenu');
        const chevronIcon = document.getElementById('chevronIcon');

        dropdownBtn.addEventListener('click', () => {
            dropdownMenu.classList.toggle('hidden');
            chevronIcon.classList.toggle('rotate-180');
        });

        document.addEventListener('click', (e) => {
            if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                dropdownMenu.classList.add('hidden');
                chevronIcon.classList.remove('rotate-180');
            }
        });
    </script>
</body>


</html>
