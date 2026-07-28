<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('vehicle_models', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('brand_id')->constrained('vehicle_brands');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('vehicle_models'); } };