<?php

namespace Database\Seeders;

use App\Models\Tag;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    // public function run(): void
    // {
    //     // User::factory(10)->create();

    //     User::factory()->create([
    //         'name' => 'Test User',
    //         'email' => 'test@example.com',
    //         'password' => bcrypt('password'),
    //     ]);
    // }

    public function run()
    {
        // 1. Create roles using Spatie
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);
        $guestRole = Role::create(['name' => 'guest']);

        // 2. Create categories
        $categories = Category::insert([
            ['name' => 'Technology'],
            ['name' => 'Health'],
            ['name' => 'Education'],
            ['name' => 'Sports'],
            ['name' => 'Entertainment'],
        ]);

        // 3. Create tags
        $tags = Tag::insert([
            ['name' => 'Laravel'],
            ['name' => 'VueJS'],
            ['name' => 'PHP'],
            ['name' => 'Health Tips'],
            ['name' => 'Sports News'],
            ['name' => 'Movies'],
            ['name' => 'Fitness'],
            ['name' => 'Web Development'],
            ['name' => 'Tech News'],
            ['name' => 'Education Tips'],
        ]);

        // 4. Create users
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'),
        ]);
        $user->assignRole('user');

        $guest = User::create([
            'name' => 'Guest User',
            'email' => 'guest@example.com',
            'password' => bcrypt('password123'),
        ]);
        $guest->assignRole('guest');

        // 5. Create posts and associate them with users, categories, and tags
        // Admin's posts
        for ($i = 0; $i < 5; $i++) {
            $post = Post::create([
                'title' => "Admin Post $i",
                'content' => "This is the content for Admin's post $i.",
                'user_id' => $admin->id,
                'category_id' => Category::inRandomOrder()->first()->id, // Random category
            ]);
            // Attach random tags to the post
            $post->tags()->attach(Tag::inRandomOrder()->take(2)->pluck('id')->toArray());
        }

        // User's posts
        for ($i = 0; $i < 3; $i++) {
            $post = Post::create([
                'title' => "User Post $i",
                'content' => "This is the content for User's post $i.",
                'user_id' => $user->id,
                'category_id' => Category::inRandomOrder()->first()->id, // Random category
            ]);
            // Attach random tags to the post
            $post->tags()->attach(Tag::inRandomOrder()->take(2)->pluck('id')->toArray());
        }

        // Guest's posts
        for ($i = 0; $i < 2; $i++) {
            $post = Post::create([
                'title' => "Guest Post $i",
                'content' => "This is the content for Guest's post $i.",
                'user_id' => $guest->id,
                'category_id' => Category::inRandomOrder()->first()->id, // Random category
            ]);
            // Attach random tags to the post
            $post->tags()->attach(Tag::inRandomOrder()->take(2)->pluck('id')->toArray());
        }
    }
}
