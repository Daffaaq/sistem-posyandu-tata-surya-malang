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
            [
                'nama_obat_vitamin' => 'Vitamin A',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin A untuk menjaga kesehatan mata dan meningkatkan daya tahan tubuh.',
                'stok' => 100,
                'tanggal_kadaluarsa' => Carbon::parse('2025-12-31')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Paracetamol',
                'tipe' => 'obat',
                'deskripsi' => 'Obat penurun panas dan pereda nyeri untuk anak-anak dan dewasa.',
                'stok' => 50,
                'tanggal_kadaluarsa' => Carbon::parse('2026-05-15')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Multivitamin Anak',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin untuk mendukung tumbuh kembang anak, meningkatkan nafsu makan.',
                'stok' => 80,
                'tanggal_kadaluarsa' => Carbon::parse('2025-10-10')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Suplemen Ibu Hamil',
                'tipe' => 'vitamin',
                'deskripsi' => 'Suplemen untuk ibu hamil yang mengandung asam folat dan zat besi.',
                'stok' => 120,
                'tanggal_kadaluarsa' => Carbon::parse('2025-08-20')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Syrup Obat Batuk',
                'tipe' => 'obat',
                'deskripsi' => 'Syrup obat batuk untuk meredakan batuk dan sakit tenggorokan.',
                'stok' => 60,
                'tanggal_kadaluarsa' => Carbon::parse('2026-02-28')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Diare Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengatasi diare ringan pada anak-anak.',
                'stok' => 40,
                'tanggal_kadaluarsa' => Carbon::parse('2025-11-11')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Zat Besi',
                'tipe' => 'vitamin',
                'deskripsi' => 'Suplemen zat besi untuk mencegah dan mengatasi anemia.',
                'stok' => 90,
                'tanggal_kadaluarsa' => Carbon::parse('2026-01-01')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Vitamin D',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin D untuk mendukung pertumbuhan tulang dan sistem imun anak.',
                'stok' => 75,
                'tanggal_kadaluarsa' => Carbon::parse('2025-09-09')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'ORS (Oralit)',
                'tipe' => 'obat',
                'deskripsi' => 'Larutan oralit untuk mengganti cairan tubuh akibat diare.',
                'stok' => 110,
                'tanggal_kadaluarsa' => Carbon::parse('2025-07-15')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Salep Kulit Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Salep untuk mengatasi ruam, gatal, dan iritasi ringan pada kulit anak.',
                'stok' => 5,
                'tanggal_kadaluarsa' => Carbon::parse('2025-04-30')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Vitamin C',
                'tipe' => 'vitamin',
                'deskripsi' => 'Vitamin C untuk meningkatkan daya tahan tubuh dan membantu penyerapan zat besi.',
                'stok' => 95,
                'tanggal_kadaluarsa' => Carbon::parse('2026-03-03')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Cacing Anak',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk membasmi cacing dalam saluran pencernaan anak.',
                'stok' => 85,
                'tanggal_kadaluarsa' => Carbon::parse('2026-06-01')->format('Y-m-d'),
            ],

            //kadaluarsa
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
            [
                'nama_obat_vitamin' => 'Pill Anti Alergi',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengatasi alergi, gatal-gatal, dan ruam.',
                'stok' => 15,
                'tanggal_kadaluarsa' => Carbon::parse('2025-03-25')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Luka Bakar',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengobati luka bakar ringan.',
                'stok' => 8,
                'tanggal_kadaluarsa' => Carbon::parse('2025-04-15')->format('Y-m-d'),
            ],
            [
                'nama_obat_vitamin' => 'Obat Sakit Gigi',
                'tipe' => 'obat',
                'deskripsi' => 'Obat untuk mengobati Sakit Gigi.',
                'stok' => 8,
                'tanggal_kadaluarsa' => Carbon::parse('2025-05-08')->format('Y-m-d'),
            ],
        ]);
    }
}
