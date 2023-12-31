<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'phone' => '09123456789',
            'dob' => '2000-01-01',
            'address' => '123 Main St, Anytown USA',
        ]);

        Post::factory(6)->create([
            'user_id' => $user->id
        ]);
    }
}
