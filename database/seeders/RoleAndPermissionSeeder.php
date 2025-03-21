<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'master.management']);
        Permission::create(['name' => 'user.management']);
        Permission::create(['name' => 'role.permission.management']);
        Permission::create(['name' => 'menu.management']);
        //user
        Permission::create(['name' => 'user.index']);
        Permission::create(['name' => 'user.create']);
        Permission::create(['name' => 'user.edit']);
        Permission::create(['name' => 'user.destroy']);
        Permission::create(['name' => 'user.import']);
        Permission::create(['name' => 'user.export']);

        //role
        Permission::create(['name' => 'role.index']);
        Permission::create(['name' => 'role.create']);
        Permission::create(['name' => 'role.edit']);
        Permission::create(['name' => 'role.destroy']);
        Permission::create(['name' => 'role.import']);
        Permission::create(['name' => 'role.export']);

        //permission
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.destroy']);
        Permission::create(['name' => 'permission.import']);
        Permission::create(['name' => 'permission.export']);

        //assignpermission
        Permission::create(['name' => 'assign.index']);
        Permission::create(['name' => 'assign.create']);
        Permission::create(['name' => 'assign.edit']);
        Permission::create(['name' => 'assign.destroy']);

        //assingusertorole
        Permission::create(['name' => 'assign.user.index']);
        Permission::create(['name' => 'assign.user.create']);
        Permission::create(['name' => 'assign.user.edit']);

        //menu group 
        Permission::create(['name' => 'menu-group.index']);
        Permission::create(['name' => 'menu-group.create']);
        Permission::create(['name' => 'menu-group.edit']);
        Permission::create(['name' => 'menu-group.destroy']);

        //menu item 
        Permission::create(['name' => 'menu-item.index']);
        Permission::create(['name' => 'menu-item.create']);
        Permission::create(['name' => 'menu-item.edit']);
        Permission::create(['name' => 'menu-item.destroy']);

        //tipe kunjungan
        Permission::create(['name' => 'tipe-kunjungan.index']);
        Permission::create(['name' => 'tipe-kunjungan.create']);
        Permission::create(['name' => 'tipe-kunjungan.edit']);
        Permission::create(['name' => 'tipe-kunjungan.destroy']);

        //jadwal posyandu
        Permission::create(['name' => 'jadwal-posyandu.index']);
        Permission::create(['name' => 'jadwal-posyandu.create']);
        Permission::create(['name' => 'jadwal-posyandu.edit']);
        Permission::create(['name' => 'jadwal-posyandu.destroy']);

        //obat
        Permission::create(['name' => 'obat.index']);
        Permission::create(['name' => 'obat.create']);
        Permission::create(['name' => 'obat.edit']);
        Permission::create(['name' => 'obat.destroy']);

        //kategori-kb
        Permission::create(['name' => 'kategori-kb.index']);
        Permission::create(['name' => 'kategori-kb.create']);
        Permission::create(['name' => 'kategori-kb.edit']);
        Permission::create(['name' => 'kategori-kb.destroy']);

        //jenis-kunjungan-kb
        Permission::create(['name' => 'jenis-kunjungan-kb.index']);
        Permission::create(['name' => 'jenis-kunjungan-kb.create']);
        Permission::create(['name' => 'jenis-kunjungan-kb.edit']);
        Permission::create(['name' => 'jenis-kunjungan-kb.destroy']);

        //kategori-imunisasi
        Permission::create(['name' => 'kategori-imunisasi.index']);
        Permission::create(['name' => 'kategori-imunisasi.create']);
        Permission::create(['name' => 'kategori-imunisasi.edit']);
        Permission::create(['name' => 'kategori-imunisasi.destroy']);

        //orang-tua
        Permission::create(['name' => 'orang-tua.index']);
        Permission::create(['name' => 'orang-tua.create']);
        Permission::create(['name' => 'orang-tua.edit']);
        Permission::create(['name' => 'orang-tua.destroy']);
        Permission::create(['name' => 'orang-tua.accepted']);
        Permission::create(['name' => 'orang-tua.rejected']);
        Permission::create(['name' => 'orang-tua.add-children']);

        // create roles 
        $roleUser = Role::create(['name' => 'user']);
        $roleUser->givePermissionTo([
            'dashboard',
            'user.management',
            'user.index',
        ]);

        // create Super Admin
        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

        $orangTua = Role::create(['name' => 'orang-tua']);
        $orangTua->givePermissionTo([
            'dashboard',
            'user.management',
            'orang-tua.index',
            'orang-tua.add-children'
        ]);

        //assign user id 1 ke super admin
        $user = User::find(1);
        $user->assignRole('super-admin');
        $user = User::find(2);
        $user->assignRole('user');
    }
}
