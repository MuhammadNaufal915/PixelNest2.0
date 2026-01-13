<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@pixelnest.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@pixelnest.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Illustrations', 'slug' => 'illustrations', 'description' => 'Digital illustrations and artwork'],
            ['name' => 'UI Kits', 'slug' => 'ui-kits', 'description' => 'User interface design kits'],
            ['name' => 'Posters', 'slug' => 'posters', 'description' => 'Digital posters and prints'],
            ['name' => 'Icons', 'slug' => 'icons', 'description' => 'Icon sets and packs'],
            ['name' => 'Templates', 'slug' => 'templates', 'description' => 'Design templates'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}