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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('eventCategory');
            $table->string('eventName');
            $table->text('eventDesc');
            $table->date('eventDate');
            $table->integer('eventDuration');
            $table->time('start_time');
            $table->string('eventPlace');
            $table->float('eventPrice');
            $table->integer('eventSlot');
            $table->string('eventBanner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
