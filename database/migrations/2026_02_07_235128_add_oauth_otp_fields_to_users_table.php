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
            // Google OAuth fields
            $table->string('google_id')->nullable()->unique()->after('email');
            $table->string('avatar')->nullable()->after('google_id');

            // OTP fields
            $table->string('otp_code', 6)->nullable()->after('password');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
        });

        // Make password nullable for OAuth users
        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['google_id', 'avatar', 'otp_code', 'otp_expires_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
        });
    }
};
