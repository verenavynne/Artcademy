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
            $table->date('dateOfBirth')->nullable()->after('profilePicture');;
            $table->string('profession')->nullable()->after('dateOfBirth');;
            $table->enum('gender',['female','male'])->nullable()->after('profession');
            $table->enum('role',['student','lecturer','admin'])->after('gender');
            $table->enum('userStatus',['active','inactive']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phoneNumber','profilePicture','dateOfBirth','profession','gender','role', 'userStatus']);
        });
    }
};
