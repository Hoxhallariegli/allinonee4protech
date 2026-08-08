<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_prescriptions', function (Blueprint $table) { $table->id();
            $table->foreignId('visit_id')->constrained('cm_visits');
            $table->string('medicine');
            $table->string('dosage')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_prescriptions'); } };