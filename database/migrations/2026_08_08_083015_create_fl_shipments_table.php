<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fl_shipments', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('fl_vehicles');
            $table->foreignId('driver_id')->constrained('fl_drivers');
            $table->string('origin');
            $table->string('destination');
            $table->string('status');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fl_shipments'); } };