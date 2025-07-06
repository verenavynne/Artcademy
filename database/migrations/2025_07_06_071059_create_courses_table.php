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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('courseName');
            $table->text('courseText');
            $table->string('coursePicture')->nullable();
            $table->enum('courseLevel',['dasar', 'menengah', 'lanjutan']);
            $table->enum('courseType',['lukis','tari','musik','fotografi']);
            $table->enum('coursePaymentType',['gratis','berbayar'])->nullable();
            $table->integer('courseDurationInMinutes')->nullable();
            $table->float('courseReview')->nullable();
            $table->boolean('bookmarked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
