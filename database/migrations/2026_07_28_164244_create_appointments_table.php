<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('appointments', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->datetime('appointment_date');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('appointments'); } };