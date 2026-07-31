<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('5arm_vehicles', function (Blueprint $table) { $table->id();
            $table->foreignId('brand_id')->constrained('5arm_vehicle_brands');
            $table->foreignId('model_id')->constrained('5arm_vehicle_models');
            $table->integer('year')->nullable();
            $table->foreignId('customer_id')->constrained('5arm_customers');
            $table->string('license_plate')->nullable();
            $table->string('vin')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('5arm_vehicles'); } };