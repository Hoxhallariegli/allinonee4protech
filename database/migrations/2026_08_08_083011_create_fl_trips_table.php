<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fl_trips', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('fl_vehicles');
            $table->foreignId('driver_id')->constrained('fl_drivers');
            $table->string('start_location');
            $table->string('destination');
            $table->decimal('distance');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fl_trips'); } };