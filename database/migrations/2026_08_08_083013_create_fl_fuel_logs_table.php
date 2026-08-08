<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fl_fuel_logs', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('fl_vehicles');
            $table->date('date');
            $table->decimal('amount');
            $table->decimal('cost');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fl_fuel_logs'); } };