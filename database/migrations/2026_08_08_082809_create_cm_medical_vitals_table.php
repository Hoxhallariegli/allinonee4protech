<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_medical_vitals', function (Blueprint $table) { $table->id();
            $table->foreignId('patient_id')->constrained('cm_patients');
            $table->decimal('weight_kg')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->integer('pulse_bpm')->nullable();
            $table->decimal('temperature_c')->nullable();
            $table->date('recorded_at');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_medical_vitals'); } };