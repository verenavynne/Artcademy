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
        Schema::create('zoom_registereds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('zoomId')->constrained('zooms')->onDelete('cascade');
            $table->foreignId('studentId')->constrained('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zoom_registereds');
    }
};
