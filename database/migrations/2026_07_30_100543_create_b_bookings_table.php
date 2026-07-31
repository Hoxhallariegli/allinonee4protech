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
        Schema::create('b_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barber_id')->constrained('b_barbers')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('b_services')->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->dateTime('appointment_datetime');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->boolean('reminder_enabled')->default(true);
            $table->integer('reminder_minutes')->default(30);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_bookings');
    }
};
