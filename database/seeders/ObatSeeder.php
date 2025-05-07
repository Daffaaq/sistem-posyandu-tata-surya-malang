<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('obats')->insert([
            // Kadaluarsa 1 tahun ke depan
            [
                'nama_obat_vitamin' => 'Vitamin A',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin A untuk menjaga kesehatan mata dan meningkatkan daya tahan tubuh.',
                'stok' => 100,
                'tanggal_kadaluarsa' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Paracetamol',
                'tipe' => 'obat',
                'deskripsi' => 'Obat penurun panas dan pereda nyeri untuk anak-anak dan dewasa.',
                'stok' => 50,
                'tanggal_kadaluarsa' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Syrup Obat Batuk',
                'tipe' => 'obat',
                'deskripsi' => 'Syrup obat batuk untuk meredakan batuk dan sakit tenggorokan.',
                'stok' => 60,
                'tanggal_kadaluarsa' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Zat Besi',
                'tipe' => 'vitamin',
                'deskripsi' => 'Suplemen zat besi untuk mencegah dan mengatasi anemia.',
                'stok' => 90,
                'tanggal_kadaluarsa' => Carbon::now()->addYear()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Vitamin C',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin C untuk meningkatkan daya tahan tubuh dan membantu penyerapan zat besi.',
                'stok' => 95,
                'tanggal_kadaluarsa' => Carbon::now()->addYear()->format('Y-m-d'),
            ],

            // Kadaluarsa 6 bulan ke depan
            [
                'nama_obat_vitamin' => 'Multivitamin Anak',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin untuk mendukung tumbuh kembang anak, meningkatkan nafsu makan.',
                'stok' => 80,
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(6)->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Suplemen Ibu Hamil',
                'tipe' => 'vitamin',
                'deskripsi' => 'Suplemen untuk ibu hamil yang mengandung asam folat dan zat besi.',
                'stok' => 120,
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(6)->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Diare Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengatasi diare ringan pada anak-anak.',
                'stok' => 40,
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(6)->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'ORS (Oralit)',
                'tipe' => 'obat',
                'deskripsi' => 'Larutan oralit untuk mengganti cairan tubuh akibat diare.',
                'stok' => 110,
                'tanggal_kadaluarsa' => Carbon::now()->addMonths(6)->format('Y-m-d'),
            ],

            // Kadaluarsa 1 bulan ke depan
            [
                'nama_obat_vitamin' => 'Salep Kulit Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Salep untuk mengatasi ruam, gatal, dan iritasi ringan pada kulit anak.',
                'stok' => 5,
                'tanggal_kadaluarsa' => Carbon::now()->addMonth()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Vitamin D',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin D untuk mendukung pertumbuhan tulang dan sistem imun anak.',
                'stok' => 75,
                'tanggal_kadaluarsa' => Carbon::now()->addMonth()->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Cacing Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk membasmi cacing dalam saluran pencernaan anak.',
                'stok' => 85,
                'tanggal_kadaluarsa' => Carbon::now()->addMonth()->format('Y-m-d'),
            ],

            // Sudah kadaluarsa
            [
                'nama_obat_vitamin' => 'Antibiotik',
                'tipe' => 'obat',
                'deskripsi' => 'Antibiotik untuk mengobati infeksi bakteri.',
                'stok' => 30,
                'tanggal_kadaluarsa' => Carbon::parse('2025-01-15')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Batuk Dewasa',
                'tipe' => 'obat',
                'deskripsi' => 'Obat batuk untuk dewasa, membantu meredakan batuk kering.',
                'stok' => 10,
                'tanggal_kadaluarsa' => Carbon::parse('2025-03-05')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Vitamin E',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin E untuk menjaga kesehatan kulit dan sebagai antioksidan.',
                'stok' => 60,
                'tanggal_kadaluarsa' => Carbon::parse('2025-02-20')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Sakit Kepala',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk meredakan sakit kepala.',
                'stok' => 20,
                'tanggal_kadaluarsa' => Carbon::parse('2025-04-10')->format('Y-m-d'),
            ],

            // Kadaluarsa 14 hari dari sekarang
            [
                'nama_obat_vitamin' => 'Pill Anti Alergi',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengatasi alergi, gatal-gatal, dan ruam.',
                'stok' => 15,
                'tanggal_kadaluarsa' => Carbon::now()->addDays(14)->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Luka Bakar',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengobati luka bakar ringan.',
                'stok' => 8,
                'tanggal_kadaluarsa' => Carbon::now()->addDays(14)->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Sakit Gigi',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengobati sakit gigi.',
                'stok' => 8,
                'tanggal_kadaluarsa' => Carbon::now()->addDays(14)->format('Y-m-d'),
            ],
        ]);
    }
}
