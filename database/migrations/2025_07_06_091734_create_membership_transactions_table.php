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
        Schema::create('membership_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('membershipId')->constrained('memberships')->onDelete('cascade');
            $table->foreignId('studentId')->constrained('students')->onDelete('cascade');
            $table->foreignId('paymentId')->constrained('payments')->onDelete('cascade');
            $table->date('startDate');
            $table->date('endDate');
            $table->enum('membershipStatus',['active','inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_transactions');
    }
};
