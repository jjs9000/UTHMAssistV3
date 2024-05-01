<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
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
        // Define your categories
        $categories = ['computer', 'programming', 'gardening', /* add more categories as needed */];

        // Iterate over categories and insert into the 'tags' table
        foreach ($categories as $category) {
            $tagName = '#' . $category;

            // Create new Tag instance and save it
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        }
    }
}
