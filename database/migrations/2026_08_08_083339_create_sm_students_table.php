<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_students', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('guardian_id')->constrained('sm_guardians');
            $table->foreignId('class_id')->constrained('sm_school_classes');
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_students'); } };