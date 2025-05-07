<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\OrangTua;
use Illuminate\Support\Facades\DB;
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
            [
                'ayah' => [
                    'nama' => 'Hendra Wijaya',
                    'tanggal_lahir' => '1960-06-21',
                    'telepon' => '081234567900',
                    'email' => 'hendra@gmail.com',
                    'pekerjaan' => 'Pengusaha',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sukarno No.6',
                ],
                'ibu' => [
                    'nama' => 'Sulastri',
                    'tanggal_lahir' => '1965-03-12',
                    'telepon' => '081234567901',
                    'email' => 'sulastri@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sukarno No.6',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'David Tanuwijaya',
                    'tanggal_lahir' => '1975-09-25',
                    'telepon' => '081234567902',
                    'email' => 'david@gmail.com',
                    'pekerjaan' => 'Dokter',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Bali No.7',
                ],
                'ibu' => [
                    'nama' => 'Clarissa Widianti',
                    'tanggal_lahir' => '1979-05-19',
                    'telepon' => '081234567903',
                    'email' => 'clarissa@gmail.com',
                    'pekerjaan' => 'Dosen',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Bali No.7',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Sudirman Harsono',
                    'tanggal_lahir' => '1968-11-11',
                    'telepon' => '081234567904',
                    'email' => 'sudirman@gmail.com',
                    'pekerjaan' => 'Manager',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Raya No.8',
                ],
                'ibu' => [
                    'nama' => 'Yuniarti',
                    'tanggal_lahir' => '1974-08-22',
                    'telepon' => '081234567905',
                    'email' => 'yuniarti@gmail.com',
                    'pekerjaan' => 'Perawat',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Raya No.8',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Bambang Setiawan',
                    'tanggal_lahir' => '1982-02-20',
                    'telepon' => '081234567906',
                    'email' => 'bambang@gmail.com',
                    'pekerjaan' => 'Pengacara',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Merpati No.9',
                ],
                'ibu' => [
                    'nama' => 'Rika Anggraini',
                    'tanggal_lahir' => '1985-01-15',
                    'telepon' => '081234567907',
                    'email' => 'rika@gmail.com',
                    'pekerjaan' => 'Notaris',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Merpati No.9',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Farhan Ahmad',
                    'tanggal_lahir' => '1970-07-05',
                    'telepon' => '081234567908',
                    'email' => 'farhan@gmail.com',
                    'pekerjaan' => 'Arsitek',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Padma No.10',
                ],
                'ibu' => [
                    'nama' => 'Siti Muna',
                    'tanggal_lahir' => '1974-12-12',
                    'telepon' => '081234567909',
                    'email' => 'sitimuna@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Padma No.10',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Rudi Hartono',
                    'tanggal_lahir' => '1972-04-18',
                    'telepon' => '081234567910',
                    'email' => 'rudi@gmail.com',
                    'pekerjaan' => 'Insinyur',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Cendana No.11',
                ],
                'ibu' => [
                    'nama' => 'Wati Susanti',
                    'tanggal_lahir' => '1976-10-02',
                    'telepon' => '081234567911',
                    'email' => 'wati@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Cendana No.11',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Rian Pratama',
                    'tanggal_lahir' => '1980-03-15',
                    'telepon' => '081234567912',
                    'email' => 'rian@gmail.com',
                    'pekerjaan' => 'Fotografer',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Pahlawan No.12',
                ],
                'ibu' => [
                    'nama' => 'Vera Amalia',
                    'tanggal_lahir' => '1982-07-10',
                    'telepon' => '081234567913',
                    'email' => 'vera@gmail.com',
                    'pekerjaan' => 'Guru',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Pahlawan No.12',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Budi Gunawan',
                    'tanggal_lahir' => '1975-12-11',
                    'telepon' => '081234567914',
                    'email' => 'budi.gunawan@gmail.com',
                    'pekerjaan' => 'Pekerja Kantoran',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sejahtera No.13',
                ],
                'ibu' => [
                    'nama' => 'Herlina Mariani',
                    'tanggal_lahir' => '1978-09-08',
                    'telepon' => '081234567915',
                    'email' => 'herlina@gmail.com',
                    'pekerjaan' => 'Dokter',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sejahtera No.13',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Agung Setiawan',
                    'tanggal_lahir' => '1968-08-30',
                    'telepon' => '081234567916',
                    'email' => 'agung.setiawan@gmail.com',
                    'pekerjaan' => 'Pengusaha',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Merdeka Raya No.14',
                ],
                'ibu' => [
                    'nama' => 'Ratna Dewi',
                    'tanggal_lahir' => '1972-05-22',
                    'telepon' => '081234567917',
                    'email' => 'ratna.dewi@gmail.com',
                    'pekerjaan' => 'Perawat',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Merdeka Raya No.14',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Yusuf Hidayat',
                    'tanggal_lahir' => '1984-11-01',
                    'telepon' => '081234567918',
                    'email' => 'yusuf.hidayat@gmail.com',
                    'pekerjaan' => 'Desainer',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sumber No.15',
                ],
                'ibu' => [
                    'nama' => 'Nina Rahmawati',
                    'tanggal_lahir' => '1986-02-17',
                    'telepon' => '081234567919',
                    'email' => 'nina.rahmawati@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Sumber No.15',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Joko Santoso',
                    'tanggal_lahir' => '1970-03-10',
                    'telepon' => '081234567920',
                    'email' => 'joko.santoso@gmail.com',
                    'pekerjaan' => 'PNS',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Harapan No.16',
                ],
                'ibu' => [
                    'nama' => 'Tini Suryani',
                    'tanggal_lahir' => '1975-05-20',
                    'telepon' => '081234567921',
                    'email' => 'tini.suryani@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Harapan No.16',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Eko Prabowo',
                    'tanggal_lahir' => '1973-07-14',
                    'telepon' => '081234567922',
                    'email' => 'eko.prabowo@gmail.com',
                    'pekerjaan' => 'Pengusaha',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Anggrek No.17',
                ],
                'ibu' => [
                    'nama' => 'Dewi Rahayu',
                    'tanggal_lahir' => '1978-12-09',
                    'telepon' => '081234567923',
                    'email' => 'dewi.rahayu@gmail.com',
                    'pekerjaan' => 'Dosen',
                    'agama' => 'Kristen',
                    'alamat' => 'Jl. Anggrek No.17',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Hadi Wijaya',
                    'tanggal_lahir' => '1980-09-05',
                    'telepon' => '081234567924',
                    'email' => 'hadi.wijaya@gmail.com',
                    'pekerjaan' => 'Arsitek',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Kembang No.18',
                ],
                'ibu' => [
                    'nama' => 'Lina Suhartini',
                    'tanggal_lahir' => '1982-11-22',
                    'telepon' => '081234567925',
                    'email' => 'lina.suhartini@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Kembang No.18',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Mulyanto Jaya',
                    'tanggal_lahir' => '1976-01-25',
                    'telepon' => '081234567926',
                    'email' => 'mulyanto.jaya@gmail.com',
                    'pekerjaan' => 'Wiraswasta',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Raya No.19',
                ],
                'ibu' => [
                    'nama' => 'Siti Suryani',
                    'tanggal_lahir' => '1980-03-18',
                    'telepon' => '081234567927',
                    'email' => 'siti.suryani@gmail.com',
                    'pekerjaan' => 'Pedagang',
                    'agama' => 'Hindu',
                    'alamat' => 'Jl. Raya No.19',
                ],
            ],
            [
                'ayah' => [
                    'nama' => 'Bambang Irawan',
                    'tanggal_lahir' => '1974-08-12',
                    'telepon' => '081234567928',
                    'email' => 'bambang.irawan@gmail.com',
                    'pekerjaan' => 'Karyawan Swasta',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Merdeka No.20',
                ],
                'ibu' => [
                    'nama' => 'Siti Aisyah',
                    'tanggal_lahir' => '1979-06-14',
                    'telepon' => '081234567929',
                    'email' => 'siti.aisyah@gmail.com',
                    'pekerjaan' => 'Ibu Rumah Tangga',
                    'agama' => 'Islam',
                    'alamat' => 'Jl. Merdeka No.20',
                ],
            ],
        ];

        $dataOrtuBulk = [];
        foreach ($dataOrtu as $data) {
            // Buat user dengan nama dan email ibu
            $user = User::create([
                'name' => $data['ibu']['nama'],
                'email' => $data['ibu']['email'],
                'password' => Hash::make('password'),
                'is_active' => 'active',
            ]);

            $user->assignRole('orang-tua');

            // Siapkan data untuk bulk insert
            $dataOrtuBulk[] = [
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
            ];
        }

        // Bulk insert data orang tua
        DB::table('orang_tuas')->insert($dataOrtuBulk);
    }
}
