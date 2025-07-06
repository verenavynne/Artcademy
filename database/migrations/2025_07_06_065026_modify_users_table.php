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
        Schema::table('users', function (Blueprint $table) {
            $table->string('phoneNumber', 15)->after('password');
            $table->string('profilePicture')->nullable()->after('phoneNumber');
            $table->enum('role',['student','lecturer','admin'])->after('profilePicture');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phoneNumber','profilePicture','role']);
        });
    }
};
