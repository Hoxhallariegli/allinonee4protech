<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('agri_fields', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->decimal('area_size');
            $table->string('soil_type');
            $table->string('location_photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('agri_fields'); } };