<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_assignments', function (Blueprint $table) { $table->id();
            $table->foreignId('school_class_id')->constrained('sm_school_classes');
            $table->foreignId('subject_id')->constrained('sm_subjects');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_assignments'); } };