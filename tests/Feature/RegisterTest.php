<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register_with_orang_tua_data()
    {
        $response = $this->post('/register', [
            'name' => 'Siti Aminah',
            'email' => 'siti@gmail.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',

            'nama_ayah' => 'Achmad Mubarok',
            'tanggal_lahir_ayah' => '1998-01-01',
            'no_telepon_ayah' => '08123456789',
            'email_ayah' => 'achmad@gmail.com',
            'pekerjaan_ayah' => 'Guru',
            'agama_ayah' => 'Islam',
            'alamat_ayah' => 'Jl. Kenanga 12',

            'nama_ibu' => 'Siti Aminah',
            'tanggal_lahir_ibu' => '1998-02-02',
            'no_telepon_ibu' => '08987654321',
            'email_ibu' => 'siti@gmail.com',
            'pekerjaan_ibu' => 'Ibu Rumah Tangga',
            'agama_ibu' => 'Islam',
            'alamat_ibu' => 'Jl. Kenanga 12',
        ]);

        $response->assertRedirect(route('register.success'));

        $this->assertDatabaseHas('users', [
            'email' => 'siti@gmail.com',
            'is_active' => 'non-active',
        ]);

        $user = User::where('email', 'siti@gmail.com')->first();

        $this->assertDatabaseHas('orang_tuas', [
            'user_id' => $user->id,
            'nama_ayah' => 'Achmad Mubarok',
            'nama_ibu' => 'Siti Aminah',
        ]);
    }
}
