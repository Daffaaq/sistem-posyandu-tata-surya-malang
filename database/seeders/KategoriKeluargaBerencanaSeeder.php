<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KategoriKeluargaBerencanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_keluarga_berencanas')->insert([
            [
                'nama_kategori_keluarga_berencana' => 'KB Implan',
                'deskripsi' => 'Jenis kontrasepsi yang melibatkan pemasangan implan untuk mencegah kehamilan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_keluarga_berencana' => 'KB Pil',
                'deskripsi' => 'Kontrasepsi oral yang digunakan setiap hari untuk mencegah kehamilan.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_keluarga_berencana' => 'KB Suntik',
                'deskripsi' => 'Jenis kontrasepsi yang melibatkan suntikan untuk mencegah kehamilan selama jangka waktu tertentu.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_keluarga_berencana' => 'KB IUD',
                'deskripsi' => 'Intrauterine Device (IUD), alat kontrasepsi yang dipasang di dalam rahim.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_keluarga_berencana' => 'KB Sterilisasi',
                'deskripsi' => 'Prosedur medis yang melibatkan sterilisasi untuk mencegah kehamilan secara permanen.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
