<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends Factory<Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'content' => fake()->paragraph(5),
            'image' => 'posts/69TE3F5gI1K8gHh1vmNhkG07oVdqmkNHMTkvBfXx.png',
            'slug' => Str::slug($title),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'user_id' => 1,
            'published_at' => fake()->optional()->dateTime()
        ];
    }
}
