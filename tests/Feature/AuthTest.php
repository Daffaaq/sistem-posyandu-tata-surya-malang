<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    protected function createActiveUserWithRole(string $roleName = 'admin', string $password = 'admin123', string $status = 'active'): User
    {
        $role = Role::firstOrCreate(['name' => $roleName]);

        $user = User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make($password),
            'is_active' => $status, // Set user active status
        ]);

        $user->assignRole($role);

        return $user;
    }

    public function test_user_can_login_with_role()
    {
        $password = 'admin123';
        $user = $this->createActiveUserWithRole('admin', $password, 'active'); // active user

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        $response->assertStatus(302); // Redirect after login
        $this->assertAuthenticatedAs($user);
        $this->assertTrue($user->hasRole('admin'));

        $logoutResponse = $this->post('/logout');
        $logoutResponse->assertStatus(302); // Redirect after logout
        $this->assertGuest();
    }

    public function test_inactive_user_is_redirected_to_inactive_page()
    {
        $password = 'admin123';
        $user = $this->createActiveUserWithRole('admin', $password, 'non-active'); // non-active user

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Check that user is redirected to the 'account.inactive' route
        $response->assertRedirect(route('account.inactive'));
    }
}
