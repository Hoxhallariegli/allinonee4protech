<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_job_cards', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('arm_vehicles');
            $table->foreignId('customer_id')->constrained('arm_customers');
            $table->foreignId('mechanic_id')->constrained('arm_mechanics');
            $table->string('status');
            $table->datetime('opened_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_job_cards'); } };