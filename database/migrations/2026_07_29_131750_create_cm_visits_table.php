<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_visits', function (Blueprint $table) { $table->id();
            $table->foreignId('patient_id')->constrained('cm_patients');
            $table->foreignId('doctor_id')->constrained('cm_doctors');
            $table->datetime('visit_date');
            $table->text('diagnosis')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_visits'); } };