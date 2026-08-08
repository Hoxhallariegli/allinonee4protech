<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('event_bookings', function (Blueprint $table) { $table->id();
            $table->foreignId('event_id')->constrained('event_events');
            $table->foreignId('attendee_id')->constrained('event_attendees');
            $table->enum('status', ['pending', 'confirmed', 'cancelled']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('event_bookings'); } };