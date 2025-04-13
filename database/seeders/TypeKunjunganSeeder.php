<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('type_kunjungans')->insert([
            [
                'nama_tipe_kunjungan' => 'Posyandu Rutin',
                'deskripsi' => 'Kunjungan rutin bagi ibu hamil untuk pemeriksaan kesehatan dan pemberian nutrisi.',
            ],
            [
                'nama_tipe_kunjungan' => 'Posyandu Tidak Rutin',
                'deskripsi' => 'Kunjungan Posyandu yang dilakukan secara tidak terjadwal, biasanya disesuaikan dengan kebutuhan atau ketersediaan petugas.',
            ]
        ]);
    }
}
