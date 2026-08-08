<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('pharm_prescription_items', function (Blueprint $table) { $table->id();
            $table->foreignId('prescription_id')->constrained('pharm_prescriptions');
            $table->foreignId('medicine_id')->constrained('pharm_medicines');
            $table->integer('quantity');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('pharm_prescription_items'); } };