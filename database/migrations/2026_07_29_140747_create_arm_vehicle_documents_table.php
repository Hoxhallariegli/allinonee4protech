<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_vehicle_documents', function (Blueprint $table) { $table->id();
            $table->string('type');
            $table->string('document');
            $table->foreignId('vehicle_id')->constrained('arm_vehicles');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_vehicle_documents'); } };