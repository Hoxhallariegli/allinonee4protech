<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hm_hotel_rooms', function (Blueprint $table) { $table->id();
            $table->string('room_number');
            $table->foreignId('room_type_id')->constrained('hm_room_types');
            $table->enum('status', ['available', 'occupied', 'cleaning']);
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hm_hotel_rooms'); } };