<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

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
            'bio' => 'I am an admin, I am a student',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Hash the password
            'usertype' => 'admin',
            'date_of_birth' => '1990-01-01', // Sample date of birth
            'contact_number' => '123456789', // Sample contact number
            'address' => '123 Admin Street', // Sample address
            'post_code' => '12345', // Sample postal code
            'city' => 'Admin City', // Sample city
            'state' => 'Admin State', // Sample state
            'ic' => 'A1234567', // Sample IC
        ]);

        // Seed one regular user
        User::create([
            'username' => 'user',
            'first_name' => 'Regular',
            'last_name' => 'User',
            'bio' => 'I am the user, I am a student',
            'email' => 'user@example.com',
            'password' => bcrypt('password'), // Hash the password
            'usertype' => 'user',
            'date_of_birth' => '1990-01-01', // Sample date of birth
            'contact_number' => '123456789', // Sample contact number
            'address' => '123 User Street', // Sample address
            'post_code' => '54321', // Sample postal code
            'city' => 'User City', // Sample city
            'state' => 'User State', // Sample state
            'ic' => 'B7654321', // Sample IC
        ]);

        // Seed 50 random users using Faker
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            User::create([
                'username' => $faker->userName,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'bio' => $faker->paragraph,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Hash the password
                'usertype' => 'user',
                'date_of_birth' => $faker->date(),
                'contact_number' => $faker->phoneNumber,
                'address' => $faker->address,
                'post_code' => $faker->postcode,
                'city' => $faker->city,
                'state' => $faker->state,
                'ic' => strtoupper($faker->bothify('??######')), // Random string for IC
            ]);
        }
    }
}
