<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Seed one admin
        User::create([
            'username' => 'admin',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Hash the password
            'usertype' => 'admin',
            'date_of_birth' => '1990-01-01', // Sample date of birth
            'contact_number' => '123456789', // Sample contact number
            'address' => '123 Admin Street', // Sample address
            'post_code' => '12345', // Sample postal code
            'city' => 'Admin City', // Sample city
            'state' => 'Admin State', // Sample state
            // Add other fields as needed
        ]);

        // Seed one regular user
        User::create([
            'username' => 'user',
            'first_name' => 'Regular',
            'last_name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Hash the password
            'usertype' => 'user',
            'date_of_birth' => '1990-01-01', // Sample date of birth
            'contact_number' => '123456789', // Sample contact number
            'address' => '123 User Street', // Sample address
            'post_code' => '54321', // Sample postal code
            'city' => 'User City', // Sample city
            'state' => 'User State', // Sample state
            // Add other fields as needed
        ]);
    }
}
