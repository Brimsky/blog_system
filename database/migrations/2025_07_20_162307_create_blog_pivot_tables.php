<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Change table name from 'post_category' to 'category_post' (Laravel convention)
        Schema::create('category_post', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->primary(['category_id', 'post_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_post');
    }
};
