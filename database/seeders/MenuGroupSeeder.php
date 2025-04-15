<?php

namespace Database\Seeders;

use App\Models\MenuGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuGroup::insert(
            [
                [
                    // ID 1
                    'name' => 'Dashboard',
                    'icon' => 'fas fa-tachometer-alt',
                    'permission_name' => 'dashboard',
                ],
                [
                    // ID 2
                    'name' => 'Master Management', // Menambahkan grup menu baru
                    'icon' => 'fas fa-cogs', // Bisa menggunakan ikon yang sesuai
                    'permission_name' => 'master.management',
                ],
                [
                    // ID 3
                    'name' => 'Posyandu Management', // Posyandu Management (ID 3)
                    'icon' => 'fas fa-notes-medical',
                    'permission_name' => 'posyandu.management',
                ],
                [
                    // ID 4
                    'name' => 'Berita Management', // Berita (ID 4)
                    'icon' => 'fas fa-newspaper',
                    'permission_name' => 'berita.management',
                ],
                [
                    // ID 5
                    'name' => 'Users Management',
                    'icon' => 'fas fa-users',
                    'permission_name' => 'user.management',
                ],
                [
                    // ID 6
                    'name' => 'Role Management',
                    'icon' => 'fas fa-user-tag',
                    'permisison_name' => 'role.permission.management',
                ],
                [
                    // ID 7
                    'name' => 'Menu Management',
                    'icon' => 'fas fa-bars',
                    'permisison_name' => 'menu.management',
                ],
                [
                    // ID 8
                    'name' => 'Log Management', // Log Sistem (ID 5)
                    'icon' => 'fas fa-file-alt',
                    'permission_name' => 'log.management',
                ],
            ]
        );
    }
}
