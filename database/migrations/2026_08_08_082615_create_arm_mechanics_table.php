<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_mechanics', function (Blueprint $table) { $table->id();
            $table->foreignId('employee_id')->constrained('arm_employees');
            $table->string('specialization')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_mechanics'); } };