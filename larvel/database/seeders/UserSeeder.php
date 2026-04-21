<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Mr',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'is_admin' => true,
        ]);

        User::create([
            'first_name' => 'Mr',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
