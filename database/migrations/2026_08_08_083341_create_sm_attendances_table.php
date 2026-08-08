<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_attendances', function (Blueprint $table) { $table->id();
            $table->foreignId('student_id')->constrained('sm_students');
            $table->foreignId('class_id')->constrained('sm_school_classes');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_attendances'); } };