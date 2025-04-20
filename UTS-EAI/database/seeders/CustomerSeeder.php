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
        // Customer data with unique information and corresponding user_ids
        $customers = [
            [
                'name' => 'Michael Brown',
                'phone_number' => '081234567890',
                'email' => 'michaelbrown@customer.com',
                'user_id' => 2, // Links to John Doe's user account
            ],
            [
                'name' => 'Sarah Johnson',
                'phone_number' => '082345678901',
                'email' => 'sarahjohnson@customer.com',
                'user_id' => 3, // Links to Jane Smith's user account
            ],
            [
                'name' => 'David Lee',
                'phone_number' => '083456789012',
                'email' => 'davidlee@customer.com',
                'user_id' => 4, // Links to Bob Wilson's user account
            ],
            [
                'name' => 'Emily Davis',
                'phone_number' => '084567890123',
                'email' => 'emilydavis@customer.com',
                'user_id' => 5, // Links to Lisa Anderson's user account
            ],
            [
                'name' => 'James Wilson',
                'phone_number' => '085678901234',
                'email' => 'jameswilson@customer.com',
                'user_id' => 6, // Links to Robert Taylor's user account
            ]
        ];

        // Create customers with unique IDs and data
        foreach ($customers as $customerData) {
            Customer::create($customerData);
        }
    }
} 