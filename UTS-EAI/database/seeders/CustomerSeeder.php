<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fixed unique user IDs for customers
        $userIds = [2, 3, 4, 5, 6];

        Customer::create([
            'name' => 'Michael Brown',
            'phone_number' => '081234567890',
            'email' => 'michael@eai.com',
            'user_id' => $userIds[0], // 2
        ]);

        Customer::create([
            'name' => 'Sarah Johnson',
            'phone_number' => '082345678901',
            'email' => 'sarah@eai.com',
            'user_id' => $userIds[1], // 3
        ]);

        Customer::create([
            'name' => 'David Lee',
            'phone_number' => '083456789012',
            'email' => 'david@eai.com',
            'user_id' => $userIds[2], // 4
        ]);

        Customer::create([
            'name' => 'Lisa Anderson',
            'phone_number' => '084567890123',
            'email' => 'lisa@eai.com',
            'user_id' => $userIds[3], // 5
        ]);

        Customer::create([
            'name' => 'Robert Taylor',
            'phone_number' => '085678901234',
            'email' => 'robert@eai.com',
            'user_id' => $userIds[4], // 6
        ]);
    }
} 