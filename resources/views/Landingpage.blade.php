<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posyandu Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                Posyandu<span class="text-gray-800">Digital</span>
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

                <!-- Dropdown -->
                <div class="relative group">
                    <button class="text-gray-700 hover:text-green-600 focus:outline-none flex items-center space-x-1">
                        <span>Menu</span>
                        <!-- Optional: Small Chevron Icon -->
                        <svg class="w-4 h-4 transform group-hover:rotate-180 transition-all duration-300"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="absolute left-0 hidden group-hover:block bg-white shadow-lg rounded-lg mt-2 w-40">
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
                    Solusi Digital <span class="text-green-600">Posyandu Modern</span>
                </h1>
                <p class="text-gray-600 text-lg">
                    Mudahkan pencatatan data balita, imunisasi, dan stok vitamin hanya dalam satu platform.
                </p>
                <div class="flex justify-center lg:justify-start gap-4">
                    <a href="#features"
                        class="px-6 py-3 bg-green-600 text-white rounded-full font-semibold hover:bg-green-700 transition">
                        Lihat Fitur
                    </a>
                    <a href="#"
                        class="px-6 py-3 bg-white border border-green-600 text-green-600 rounded-full font-semibold hover:bg-green-50 transition">
                        Coba Demo
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
                <div class="w-full lg:w-1/2">
                    <img src="https://img.freepik.com/free-photo/medical-banner-with-doctor-holding-tablet_23-2149611236.jpg?t=st=1745065396~exp=1745068996~hmac=f57ab67ba3430b4025ce34479ed78ca128f23323d56220e3c2ab391ae3613164&w=1380"
                        alt="Dashboard Ilustrasi" class="w-full max-w-md mx-auto">
                </div>
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Apa Itu Sistem Posyandu Digital?</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Sistem ini dirancang untuk membantu kader posyandu dalam mencatat data balita, jadwal imunisasi,
                        dan stok vitamin dengan mudah, cepat, dan akurat.
                    </p>
                    <ul class="space-y-3 text-gray-700">
                        <li>✔️ Dashboard real-time yang informatif</li>
                        <li>✔️ Pencatatan kunjungan balita & imunisasi</li>
                        <li>✔️ Monitoring vitamin & obat yang efisien</li>
                    </ul>
                </div>
            </div>

            <!-- Blok 2 -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <img src="https://img.freepik.com/free-photo/medical-examination-report-history-history_53876-132763.jpg?t=st=1745065633~exp=1745069233~hmac=150db422dcd88ded5dc83a19065dbe14ab81f22af6485ca9e13078928c87dcb8&w=1480"
                        alt="Ilustrasi Sistem" class="w-full max-w-md mx-auto">
                </div>
                <div class="w-full lg:w-1/2">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Kenapa Harus Pakai Sistem Ini?</h2>
                    <p class="text-gray-600 text-lg mb-6">
                        Dibuat khusus untuk posyandu dengan pendekatan digital yang ramah pengguna. Meningkatkan
                        efisiensi tanpa perlu pelatihan yang rumit.
                    </p>
                    <ul class="space-y-3 text-gray-700">
                        <li>✔️ Mudah digunakan oleh kader dari berbagai usia</li>
                        <li>✔️ Akses dari perangkat apa pun (HP / Laptop)</li>
                        <li>✔️ Siap cetak laporan kapan saja</li>
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


</body>


</html>
