<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name();
        return [
            'name' => $name,
            'username' => Str::slug($name),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function configure(): UserFactory|Factory
    {
        return $this->afterCreating(function (User $user) {
            $imageUrl = 'http://127.0.0.1:8000/storage/2/FExR3RYDXXNonCP5wurmciN8nv8jpmEuPnDftk5T.jpg';
            try {
                $user->addMediaFromUrl($imageUrl)
                    ->toMediaCollection('users');
            } catch (\Exception $e) {
                dump("Could not add media for user ID: " . $user->id . ". Error: "
                    . $e->getMessage());
            }
        });
    }
}
