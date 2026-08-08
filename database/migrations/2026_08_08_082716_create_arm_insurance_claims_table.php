<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_insurance_claims', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('arm_vehicles');
            $table->string('policy_number');
            $table->decimal('amount');
            $table->string('status');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_insurance_claims'); } };