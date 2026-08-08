<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('agri_crops', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('field_id')->constrained('agri_fields');
            $table->date('planting_date');
            $table->enum('status', ['growing', 'harvested']);
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('agri_crops'); } };