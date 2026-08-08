<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('gym_class_schedules', function (Blueprint $table) { $table->id();
            $table->string('class_name');
            $table->foreignId('trainer_id')->constrained('gym_trainers');
            $table->datetime('start_time');
            $table->datetime('end_time');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('gym_class_schedules'); } };