<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_device_tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('booking_id')->nullable()->constrained('ba_bookings')->onDelete('cascade');
            $table->text('fcm_token');
            $table->string('device_type')->nullable(); // web, android, ios
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_device_tokens');
    }
};
