<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_grades', function (Blueprint $table) { $table->id();
            $table->foreignId('student_id')->constrained('sm_students');
            $table->foreignId('exam_id')->constrained('sm_exams');
            $table->integer('score');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_grades'); } };