<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hm_reservations', function (Blueprint $table) { $table->id();
            $table->foreignId('guest_id')->constrained('hm_guests');
            $table->foreignId('room_id')->constrained('hm_hotel_rooms');
            $table->date('check_in');
            $table->date('check_out');
            $table->decimal('total_price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hm_reservations'); } };