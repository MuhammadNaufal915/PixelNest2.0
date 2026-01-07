<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Logo Design',
                'slug' => 'logo-design',
                'description' => 'Professional logo designs for brands and businesses',
            ],
            [
                'name' => 'Poster Design',
                'slug' => 'poster-design',
                'description' => 'Creative poster designs for events and promotions',
            ],
            [
                'name' => 'Illustration',
                'slug' => 'illustration',
                'description' => 'Digital and traditional illustrations',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'description' => 'User interface and user experience designs',
            ],
            [
                'name' => 'Typography',
                'slug' => 'typography',
                'description' => 'Custom typography and font designs',
            ],
            [
                'name' => 'Brand Identity',
                'slug' => 'brand-identity',
                'description' => 'Complete brand identity packages',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
