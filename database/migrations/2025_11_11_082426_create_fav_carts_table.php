<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fav_carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->boolean('state');
            $table->timestamps();

            // Composite index to prevent duplicates and speed up lookups
            $table->unique(['user_id', 'post_id']);

            // Additional indexes for faster searches
            $table->index('user_id');     // Fetch all favorites of a user
            $table->index('post_id');     // Fetch all users who favorited a post
            $table->index('state');       // Filter by state (e.g., active/inactive)
            $table->index(['user_id', 'state']); // Common query: active favorites of a user
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fav_carts');
    }
};
