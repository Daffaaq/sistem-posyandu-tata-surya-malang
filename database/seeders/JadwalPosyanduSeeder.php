<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jadwal_posyandus')->insert([
            [
                'nama_kegiatan' => 'Kunjungan Ibu Hamil',
                'tanggal_kegiatan' => Carbon::parse('2025-03-20')->format('Y-m-d'),
                'waktu_kegiatan' => '09:00:00',
                'tempat_kegiatan' => 'Lapangan Segitiga Tata Surya',
            ],
            [
                'nama_kegiatan' => 'Imunisasi Balita',
                'tanggal_kegiatan' => Carbon::parse('2025-03-22')->format('Y-m-d'),
                'waktu_kegiatan' => '09:00:00',
                'tempat_kegiatan' => 'Lapangan Segitiga Tata Surya',
            ],
        ]);
    }
}
