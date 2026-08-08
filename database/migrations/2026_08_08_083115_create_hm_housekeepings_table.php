<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hm_housekeepings', function (Blueprint $table) { $table->id();
            $table->foreignId('room_id')->constrained('hm_hotel_rooms');
            $table->text('task');
            $table->boolean('is_completed')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hm_housekeepings'); } };