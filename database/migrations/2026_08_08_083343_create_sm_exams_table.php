<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_exams', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('class_id')->constrained('sm_school_classes');
            $table->date('exam_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_exams'); } };