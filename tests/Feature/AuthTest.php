<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;


class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_with_role()
    {
        $role = Role::create(['name' => 'admin']);

        $password = 'admin123';

        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make($password),
            'is_active' => 'active',
        ]);

        $user->assignRole($role);

        $response = $this->post('/login', [
            'email' => 'admin@example.com',
            'password' => $password,
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
        $this->assertTrue($user->hasRole('admin'));

        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertStatus(302); // Biasanya redirect setelah logout
        $this->assertGuest(); // Pastikan user udah logout
    }
}
