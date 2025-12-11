<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
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
                'slug' => Str::slug($category),
                'name' => $category,
            ]);
        }
    }
}
