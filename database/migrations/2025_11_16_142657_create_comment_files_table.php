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
        Schema::create('comment_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('commentId')->constrained('comments')->onDelete('cascade');
            $table->string('filePath');
            $table->enum('fileType',['image','video']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_files');
    }
};
