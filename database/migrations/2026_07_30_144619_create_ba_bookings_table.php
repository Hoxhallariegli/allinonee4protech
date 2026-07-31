<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ba_bookings', function (Blueprint $table) { $table->id();
            $table->foreignId('barber_id')->constrained('ba_barbers');
            $table->foreignId('service_id')->constrained('ba_services');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->datetime('appointment_datetime');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed']);
            $table->boolean('reminder_enabled');
            $table->integer('reminder_minutes');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ba_bookings'); } };