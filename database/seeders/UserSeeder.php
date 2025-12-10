<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        User::factory()->create([
            'name' => 'Jafar',
            'username' => 'jafar-marouf',
            'email' => 'jafar@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
