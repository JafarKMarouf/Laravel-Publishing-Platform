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
            'slug' => Str::slug($title),
            'category_id' => Category::query()->inRandomOrder()->first()->id,
            'user_id' => 1,
            'published_at' => fake()->optional()->dateTime()
        ];
    }

    /**
     * @return PostFactory|Factory
     */
    public function configure(): PostFactory|Factory
    {
        return $this->afterCreating(function (Post $post) {
            $imageUrl = 'http://127.0.0.1:8000/storage/1/4mGaGvbrXi9KZ2Nm0YIOOrZlI5YEXeyVCLE6SYzW.png';
            try {
                $post->addMediaFromUrl($imageUrl)
                    ->toMediaCollection('posts');
            } catch (\Exception $e) {
                dump("Could not add media for post ID: " . $post->id . ". Error: " . $e->getMessage());
            }
        });
    }
}
