<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\OrangTua;
use Spatie\Permission\Models\Role;

class OrangTuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataOrtu = [
            [
                'ayah' => [
                    'nama' => 'Budi Santoso',
                    'tanggal_lahir' => '1970-05-01',
                    'telepon' => '081234567890',
                    'email' => 'budi@gmail.com',
                    'pekerjaan' => 'PNS',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Merdeka No.1',
                ],
                'ibu' => [
                    'nama' => 'Siti Aminah',
                    'tanggal_lahir' => '1975-06-01',
                    'telepon' => '081234567891',
                    'email' => 'siti@gmail.com',
                    'pekerjaan' => 'IRT',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Merdeka No.1',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Agus Pratama',
                    'tanggal_lahir' => '1965-04-10',
                    'telepon' => '081234567892',
                    'email' => 'agus@gmail.com',
                    'pekerjaan' => 'Wiraswasta',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Melati No.2',
                ],
                'ibu' => [
                    'nama' => 'Maria Yosefa',
                    'tanggal_lahir' => '1970-07-11',
                    'telepon' => '081234567893',
                    'email' => 'maria@gmail.com',
                    'pekerjaan' => 'Guru',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Melati No.2',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Slamet Riyadi',
                    'tanggal_lahir' => '1972-02-15',
                    'telepon' => '081234567894',
                    'email' => 'slamet@gmail.com',
                    'pekerjaan' => 'Petani',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Kenanga No.3',
                ],
                'ibu' => [
                    'nama' => 'Nurhayati',
                    'tanggal_lahir' => '1976-09-09',
                    'telepon' => '081234567895',
                    'email' => 'nur@gmail.com',
                    'pekerjaan' => 'IRT',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Kenanga No.3',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Hendri Saputra',
                    'tanggal_lahir' => '1960-06-21',
                    'telepon' => '081234567896',
                    'email' => 'hendri@gmail.com',
                    'pekerjaan' => 'Pengusaha',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Mawar No.4',
                ],
                'ibu' => [
                    'nama' => 'Lina Marlina',
                    'tanggal_lahir' => '1964-08-10',
                    'telepon' => '081234567897',
                    'email' => 'lina@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Mawar No.4',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Tono Surya',
                    'tanggal_lahir' => '1978-11-30',
                    'telepon' => '081234567898',
                    'email' => 'tono@gmail.com',
                    'pekerjaan' => 'Nelayan',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Teratai No.5',
                ],
                'ibu' => [
                    'nama' => 'Dewi Lestari',
                    'tanggal_lahir' => '1980-12-15',
                    'telepon' => '081234567899',
                    'email' => 'dewi@gmail.com',
                    'pekerjaan' => 'Pedagang',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Teratai No.5',
                ],
            ],
        ];

        foreach ($dataOrtu as $data) {
            // Buat user dengan nama dan email ibu
            $user = User::create([
                'name' => $data['ibu']['nama'],
                'email' => $data['ibu']['email'],
                'password' => Hash::make('password'),
                'is_active' => 'active',
            ]);

            $user->assignRole('orang-tua');

            // Simpan data orang tua
            OrangTua::create([
                'nama_ayah' => $data['ayah']['nama'],
                'jenis_kelamin_ayah' => 'Laki-laki',
                'tanggal_lahir_ayah' => $data['ayah']['tanggal_lahir'],
                'no_telepon_ayah' => $data['ayah']['telepon'],
                'email_ayah' => $data['ayah']['email'],
                'pekerjaan_ayah' => $data['ayah']['pekerjaan'],
                'agama_ayah' => $data['ayah']['agama'],
                'alamat_ayah' => $data['ayah']['alamat'],

                'nama_ibu' => $data['ibu']['nama'],
                'jenis_kelamin_ibu' => 'Perempuan',
                'tanggal_lahir_ibu' => $data['ibu']['tanggal_lahir'],
                'no_telepon_ibu' => $data['ibu']['telepon'],
                'email_ibu' => $data['ibu']['email'],
                'pekerjaan_ibu' => $data['ibu']['pekerjaan'],
                'agama_ibu' => $data['ibu']['agama'],
                'alamat_ibu' => $data['ibu']['alamat'],

                'user_id' => $user->id,
            ]);
        }
    }
}
