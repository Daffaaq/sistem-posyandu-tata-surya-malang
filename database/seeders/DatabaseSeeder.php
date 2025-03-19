<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoleAndPermissionSeeder::class,
            MenuGroupSeeder::class,
            MenuItemSeeder::class,
            KategoriKeluargaBerencanaSeeder::class,
            JenisKunjunganKeluargaBerencanaSeeder::class,
            TypeKunjunganSeeder::class,
            JadwalPosyanduSeeder::class,
            KategoriImunisasiSeeder::class,
            ObatSeeder::class
        ]);
    }
}
