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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->timestamps();

            // Indexes for faster searching
            $table->index('user_id');                  // Fetch all transactions of a user
            $table->index('post_id');                  // Fetch all transactions for a post
            $table->index('created_at');               // Sort/filter by creation date
            $table->unique(['user_id', 'post_id']);    // Prevent duplicate transactions
            $table->index(['user_id', 'created_at']);  // Common query: recent transactions of a user
            $table->index(['post_id', 'created_at']);  // Common query: recent transactions for a post
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
