<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_patient_addresses', function (Blueprint $table) { $table->id();
            $table->foreignId('patient_id')->constrained('cm_patients');
            $table->string('line1');
            $table->string('city')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_patient_addresses'); } };