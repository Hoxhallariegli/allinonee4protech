<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_timetables', function (Blueprint $table) { $table->id();
            $table->foreignId('school_class_id')->constrained('sm_school_classes');
            $table->foreignId('subject_id')->constrained('sm_subjects');
            $table->foreignId('teacher_id')->constrained('sm_teachers');
            $table->enum('day', ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday']);
            $table->string('start_time');
            $table->string('end_time');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_timetables'); } };