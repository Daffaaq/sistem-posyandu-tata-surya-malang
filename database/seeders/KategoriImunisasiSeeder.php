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
            [
                'nama_kategori_imunisasi' => 'Imunisasi BCG',
                'keterangan' => 'Imunisasi untuk mencegah penyakit tuberkulosis (TBC).',
                'is_active' => true,
                'slug' => 'imunisasi-bcg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi MR (Measles-Rubella)',
                'keterangan' => 'Imunisasi kombinasi untuk mencegah campak dan rubella.',
                'is_active' => true,
                'slug' => 'imunisasi-mr',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi Hib',
                'keterangan' => 'Imunisasi untuk mencegah infeksi Haemophilus influenzae tipe b.',
                'is_active' => true,
                'slug' => 'imunisasi-hib',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi IPV',
                'keterangan' => 'Inactivated Polio Vaccine untuk perlindungan terhadap polio.',
                'is_active' => true,
                'slug' => 'imunisasi-ipv',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi PCV',
                'keterangan' => 'Imunisasi untuk mencegah infeksi akibat bakteri pneumokokus.',
                'is_active' => true,
                'slug' => 'imunisasi-pcv',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori_imunisasi' => 'Imunisasi Rotavirus',
                'keterangan' => 'Imunisasi untuk mencegah diare berat akibat infeksi rotavirus.',
                'is_active' => true,
                'slug' => 'imunisasi-rotavirus',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
