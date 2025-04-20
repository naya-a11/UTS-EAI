<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin account
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@eai.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create customer accounts
        User::create([
            'name' => 'John Doe',
            'email' => 'john@eai.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@eai.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Bob Wilson',
            'email' => 'bob@eai.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Lisa Anderson',
            'email' => 'lisa@eai.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        User::create([
            'name' => 'Robert Taylor',
            'email' => 'robert@eai.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);
    }
} 