<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // Create a batch of 10 users with random data
       User::factory(10)->create();

        // Create a specific user with defined attributes
        User::factory()->create([
            'name' => 'TestUser',
            'email' => 'test@example.com',
            'password' => Hash::make('123456789Qa.')
        ]);
    }
}
