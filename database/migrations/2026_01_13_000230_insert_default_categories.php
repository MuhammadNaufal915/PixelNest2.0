<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $categories = [
            ['name' => 'Logo Design', 'slug' => 'logo-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Poster Design', 'slug' => 'poster-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Illustration', 'slug' => 'illustration', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'UI/UX Design', 'slug' => 'ui-ux-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Typography', 'slug' => 'typography', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brand Identity', 'slug' => 'brand-identity', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Photography', 'slug' => 'photography', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '3D Design', 'slug' => '3d-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Animation', 'slug' => 'animation', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Web Design', 'slug' => 'web-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Icon Design', 'slug' => 'icon-design', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pattern Design', 'slug' => 'pattern-design', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('categories')->whereIn('name', [
            'Logo Design',
            'Poster Design',
            'Illustration',
            'UI/UX Design',
            'Typography',
            'Brand Identity',
            'Photography',
            '3D Design',
            'Animation',
            'Web Design',
            'Icon Design',
            'Pattern Design',
        ])->delete();
    }
};
