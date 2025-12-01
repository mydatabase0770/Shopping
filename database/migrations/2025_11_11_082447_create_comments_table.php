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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->string('comment', 500);
            $table->timestamps();

            // Indexes for faster searching
            $table->index('user_id');                  // Fetch comments by a user
            $table->index('post_id');                  // Fetch comments for a post
            $table->index('created_at');               // Sort/filter by creation date
            $table->index(['post_id', 'created_at']);  // Common query: recent comments for a post
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
