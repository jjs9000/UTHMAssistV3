<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\TaskPosting;
use App\Models\Tag;
use App\Models\User;

class TaskPostingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $tags = Tag::all();
    
        // Make sure you have some users in the users table
        $users = User::all();
    
        if ($users->isEmpty() || $tags->isEmpty()) {
            $this->command->info('No users or tags found, skipping TaskPosting seeder.');
            return;
        }
    
        // Create 50 task postings
        for ($i = 0; $i < 50; $i++) {
            // Generate random deadline after the current date
            $randomDeadline = $faker->dateTimeBetween('+1 day', '+1 month')->format('Y-m-d');
    
            // Create a task posting
            $taskPosting = TaskPosting::create([
                'user_id' => $users->random()->id,
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'requirement' => $faker->paragraph,
                'salary' => $faker->randomFloat(2, 1000, 5000),
                'location' => $faker->randomElement(['UTHM Parit Raja', 'UTHM Pagoh']), // Choose predefined location
                'location_detail' => $faker->address, // Generate random location details
                'deadline' => $randomDeadline, // Set random deadline
                'status' => $faker->randomElement(['available', 'not_available']),
            ]);
    
            // Attach random tags to the task posting
            $taskPosting->tags()->attach($tags->random(rand(1, 3))->pluck('id')->toArray());
        }
    }
}
