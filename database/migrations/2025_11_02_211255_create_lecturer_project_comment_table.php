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
        Schema::create('lecturer_project_comment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('courseLecturerId')->constrained('course_lecturers')->onDelete('cascade');
            $table->foreignId('projectSubmissionId')->constrained('project_submissions')->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lecturer_project_comment');
    }
};
