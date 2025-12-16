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
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('projectId')->constrained('projects')->onDelete('cascade');
            $table->foreignId('studentId')->constrained('students')->onDelete('cascade');
            $table->string('projectSubmissionName')->nullable();
            $table->string('projectSubmissionLink')->nullable();
            $table->string('projectSubmissionThumbnail')->nullable();
            $table->text('projectSubmissionDesc')->nullable();
            $table->dateTime('projectSubmissionDate')->nullable();
            $table->dateTime('deadlineSubmission')->nullable();
            $table->dateTime('gradingDeadline')->nullable();
            $table->enum('status',['graded','not_graded']);
            $table->float('grade')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_submissions');
    }
};
