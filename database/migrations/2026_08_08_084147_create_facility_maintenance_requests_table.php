<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('facility_maintenance_requests', function (Blueprint $table) { $table->id();
            $table->foreignId('building_id')->constrained('facility_buildings');
            $table->foreignId('technician_id')->constrained('facility_technicians');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('facility_maintenance_requests'); } };