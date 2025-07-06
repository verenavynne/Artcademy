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
            $table->foreignId('postId')->constrained('posts')->onDelete('cascade');
            $table->foreignId('userId')->constrained('users')->onDelete('cascade')->nullable();
            $table->foreignId('chatbotId')->constrained('chatbots')->onDelete('cascade')->nullable();
            $table->string('commentText');
            $table->date('commentDate');
            $table->string('commentContent')->nullable();
            $table->enum('commentBy',['user','chatbot']);
            $table->timestamps();
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
