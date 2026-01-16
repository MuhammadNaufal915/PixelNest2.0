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
            [
                'name' => 'Photography',
                'slug' => 'photography',
                'description' => 'Professional photography and photo editing',
            ],
            [
                'name' => '3D Design',
                'slug' => '3d-design',
                'description' => '3D modeling, rendering, and animation',
            ],
            [
                'name' => 'Animation',
                'slug' => 'animation',
                'description' => 'Motion graphics and animated content',
            ],
            [
                'name' => 'Web Design',
                'slug' => 'web-design',
                'description' => 'Website layouts and landing page designs',
            ],
            [
                'name' => 'Icon Design',
                'slug' => 'icon-design',
                'description' => 'Custom icon sets and icon packs',
            ],
            [
                'name' => 'Pattern Design',
                'slug' => 'pattern-design',
                'description' => 'Seamless patterns and textures',
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']], // Check by slug
                $category // Create with all data if not exists
            );
        }
    }
}
