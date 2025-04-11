<?php

namespace Database\Seeders;

use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenuItem::insert(
            [
                [
                    'name' => 'Dashboard',
                    'route' => 'dashboard',
                    'permission_name' => 'dashboard',
                    'menu_group_id' => 1,
                ],
                [
                    'name' => 'Tipe Kunjungan List',
                    'route' => 'master-management/tipe-kunjungan',
                    'permission_name' => 'tipe-kunjungan.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Kategori Imunisasi List',
                    'route' => 'master-management/kategori-imunisasi',
                    'permission_name' => 'kategori-imunisasi.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Kategori KB List',
                    'route' => 'master-management/kategori-kb',
                    'permission_name' => 'kategori-kb.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Jenis Kunjungan KB List',
                    'route' => 'master-management/jenis-kunjungan-kb',
                    'permission_name' => 'jenis-kunjungan-kb.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Jadwal Posyandu List',
                    'route' => 'master-management/jadwal-posyandu',
                    'permission_name' => 'jadwal-posyandu.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Obat List',
                    'route' => 'master-management/obat',
                    'permission_name' => 'obat.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => 'Logo Login List',
                    'route' => 'master-management/logo-login',
                    'permission_name' => 'logo-login.index',
                    'menu_group_id' => 2,
                ],
                [
                    'name' => ' Kunjungan',
                    'route' => 'posyandu-management/kunjungan',
                    'permission_name' => 'kunjungan.index',
                    'menu_group_id' => 3, // Posyandu Management
                ],
                [
                    'name' => ' Imunisasi',
                    'route' => 'posyandu-management/imunisasi',
                    'permission_name' => 'imunisasi.index',
                    'menu_group_id' => 3, // Posyandu Management
                ],
                [
                    'name' => 'Keluarga Berencana',
                    'route' => 'posyandu-management/keluarga-berencana',
                    'permission_name' => 'keluarga-berencana.index',
                    'menu_group_id' => 3, // Posyandu Management
                ],
                [
                    'name' => 'Berita List',
                    'route' => 'berita-management/index',
                    'permission_name' => 'berita.index',
                    'menu_group_id' => 4, // Berita
                ],
                [
                    'name' => 'OrangTua List',
                    'route' => 'user-management/orang-tua',
                    'permission_name' => 'orang-tua.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'User List',
                    'route' => 'user-management/user',
                    'permission_name' => 'user.index',
                    'menu_group_id' => 5,
                ],
                [
                    'name' => 'Role List',
                    'route' => 'role-and-permission/role',
                    'permission_name' => 'role.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Permission List',
                    'route' => 'role-and-permission/permission',
                    'permission_name' => 'permission.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Permission To Role',
                    'route' => 'role-and-permission/assign',
                    'permission_name' => 'assign.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'User To Role',
                    'route' => 'role-and-permission/assign-user',
                    'permission_name' => 'assign.user.index',
                    'menu_group_id' => 6,
                ],
                [
                    'name' => 'Menu Group',
                    'route' => 'menu-management/menu-group',
                    'permission_name' => 'menu-group.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Menu Item',
                    'route' => 'menu-management/menu-item',
                    'permission_name' => 'menu-item.index',
                    'menu_group_id' => 7,
                ],
                [
                    'name' => 'Log Sistem',
                    'route' => 'log-management/log-sistem',
                    'permission_name' => 'log-sistem.index',
                    'menu_group_id' => 8, // Log Sistem
                ],
            ]
        );
    }
}
