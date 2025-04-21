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
        // Create admin account with password 'admin123'
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@eai.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create customer accounts with unique emails and same password 'customer123'
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'johndoe@customer.com',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'janesmith@customer.com',
            ],
            [
                'name' => 'Bob Wilson',
                'email' => 'bobwilson@customer.com',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisaanderson@customer.com',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'roberttaylor@customer.com',
            ]
        ];

        // Create all customer accounts with the same password
        foreach ($customers as $customer) {
            User::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'password' => Hash::make('customer123'),
                'role' => 'customer',
            ]);
        }
    }
} 