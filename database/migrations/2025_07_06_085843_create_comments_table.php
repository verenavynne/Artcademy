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
            $table->unsignedBigInteger('chatbotId')->nullable();
            $table->foreign('chatbotId')->references('id')->on('chatbots')->onDelete('cascade');
            $table->unsignedBigInteger('userId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('parentId')->nullable();
            $table->foreign('parentId')->references('id')->on('comments')->onDelete('cascade');
            $table->text('commentText');
            $table->dateTime('commentDate');
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
