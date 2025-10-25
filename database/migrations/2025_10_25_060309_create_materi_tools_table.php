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
        Schema::create('materi_tools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materiId')->constrained('course_materis')->onDelete('cascade');
            $table->foreignId('toolId')->constrained('tools')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi_tools');
    }
};
