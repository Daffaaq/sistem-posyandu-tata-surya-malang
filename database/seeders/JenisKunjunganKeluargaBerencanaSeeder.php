<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisKunjunganKeluargaBerencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_kunjungan_keluarga_berencanas')->insert([
            [
                'nama_jenis_kunjungan_keluarga_berencana' => 'Kunjungan Konsultasi KB',
                'deskripsi' => 'Kunjungan untuk memberikan konsultasi mengenai berbagai metode KB yang tersedia.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_kunjungan_keluarga_berencana' => 'Kunjungan Pemeriksaan Kesehatan',
                'deskripsi' => 'Kunjungan untuk memeriksa kondisi kesehatan pengguna KB dan memastikan kesesuaian metode KB yang digunakan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_jenis_kunjungan_keluarga_berencana' => 'Kunjungan Pemasangan Alat Kontrasepsi',
                'deskripsi' => 'Kunjungan untuk pemasangan alat kontrasepsi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // [
            //     'nama_jenis_kunjungan_keluarga_berencana' => 'Kunjungan Pemeliharaan dan Pemantauan',
            //     'deskripsi' => 'Kunjungan untuk memastikan bahwa metode kontrasepsi yang digunakan tetap efektif dan tidak menimbulkan masalah kesehatan.',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
        ]);
    }
}
