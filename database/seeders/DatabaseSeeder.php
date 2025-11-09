<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $categories = [
            'Technology',
            'Sport',
            'Science',
            'Music',
            'Entertainment',
            'Fashion',
            'Politics',
        ];

        foreach ($categories as $category) {
            Category::query()->create([
                'name' => $category,
            ]);
        }

        Post::factory(100)->create();
    }
}
