<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $categories = [
            ['name' => 'Technology', 'slug' => 'technology', 'description' => 'Tech news and tutorials'],
            ['name' => 'Lifestyle', 'slug' => 'lifestyle', 'description' => 'Life and lifestyle content'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and entrepreneurship'],
            ['name' => 'Travel', 'slug' => 'travel', 'description' => 'Travel guides and experiences'],
            ['name' => 'Food', 'slug' => 'food', 'description' => 'Recipes and food reviews']
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function down(): void
    {
        DB::table('categories')->truncate();
    }
};
