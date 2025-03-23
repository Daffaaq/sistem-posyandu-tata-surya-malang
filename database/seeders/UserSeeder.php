<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => "SuperAdmin",
            'email' => "superadmin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => 'active',
        ]);
        User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => 'active',
        ]);
        User::create([
            'name' => "Zahra",
            'email' => "zahra@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => 'active',
        ]);
        User::create([
            'name' => "Zulkifli",
            'email' => "zulkifli@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => 'active',
        ]);
        User::create([
            'name' => "Nadia",
            'email' => "nadia@gmail.com",
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'is_active' => 'active',
        ]);
    }
}
