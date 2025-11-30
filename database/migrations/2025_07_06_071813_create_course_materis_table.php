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
        Schema::create('course_materis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('weekId')->constrained('course_weeks')->onDelete('cascade');
            $table->string('articleName')->nullable();
            $table->text('articleText')->nullable();
            $table->string('vblName')->nullable();
            $table->text('vblDesc')->nullable();
            $table->string('vblUrl')->nullable();
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_materis');
    }
};
