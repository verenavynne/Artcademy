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
        Schema::create('notificiations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('actorId')->nullable();
            $table->foreign('actorId')->references('id')->on('users')->onDelete('cascade');
            $table->string('notificationMessage');
            $table->date('notificationDate');
            $table->enum('referenceType',['event', 'membership', 'post', 'comment','project']);
            $table->unsignedBigInteger('referenceId')->nullable();
            $table->enum('status',['read','unread']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificiations');
    }
};
