<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('pharm_prescriptions', function (Blueprint $table) { $table->id();
            $table->string('patient_name');
            $table->string('doctor_name')->nullable();
            $table->date('date');
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('pharm_prescriptions'); } };