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
        ]);
    }
}
