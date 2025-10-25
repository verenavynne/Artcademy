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
        Schema::create('student_materi_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseEnrollmentId')->constrained('course_enrollments')->onDelete('cascade');
            $table->foreignId('materiId')->constrained('course_materis')->onDelete('cascade');
            $table->boolean('isDone')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_materi_progress');
    }
};
