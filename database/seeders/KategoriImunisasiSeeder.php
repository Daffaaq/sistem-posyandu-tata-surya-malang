<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('kategori_imunasasis')->insert([
            [
                'nama_kategori_imunisasi' => 'Imunisasi DPT',
                'keterangan' => 'Imunisasi untuk mencegah penyakit difteri, pertusis, dan tetanus.',
                'is_active' => true,
                'slug' => 'imunisasi-dpt',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi Polio',
                'keterangan' => 'Imunisasi untuk mencegah penyakit polio.',
                'is_active' => true,
                'slug' => 'imunisasi-polio',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi Hepatitis B',
                'keterangan' => 'Imunisasi untuk mencegah infeksi virus hepatitis B.',
                'is_active' => true,
                'slug' => 'imunisasi-hepatitis-b',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi Campak',
                'keterangan' => 'Imunisasi untuk mencegah penyakit campak.',
                'is_active' => true,
                'slug' => 'imunisasi-campak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more entries as needed
        ]);
    }
}
