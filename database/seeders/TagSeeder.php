<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Tag;

/**
 * Class TagSeeder
 *
 * @package Database\Seeders
 */

 class TagSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      */
     public function run(): void
     {
         $faker = Faker::create();
 
         for ($i = 0; $i < 10; $i++) {
             $tagName = $faker->unique()->word; // Unique random tag name
             $description = $faker->sentence(); // Random description
 
             // Create new Tag instance and save it
             $tag = new Tag();
             $tag->name = $tagName;
             $tag->description = $description;
             $tag->save();
         }
     }
 }
