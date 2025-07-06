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
        Schema::create('students_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('certificateId')->constrained('certificates')->onDelete('cascade');
            $table->foreignId(column: 'studentId')->constrained('students')->onDelete('cascade');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_certificates');
    }
};
