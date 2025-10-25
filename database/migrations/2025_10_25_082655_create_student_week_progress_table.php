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
        Schema::create('student_week_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseEnrollmentId')->constrained('course_enrollments')->onDelete('cascade');
            $table->foreignId('weekId')->constrained('course_weeks')->onDelete('cascade');
            $table->float('progress')->default(0);
            $table->enum('status',['locked','unlocked'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_week_progress');
    }
};
