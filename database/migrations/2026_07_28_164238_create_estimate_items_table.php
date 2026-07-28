<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('estimate_items', function (Blueprint $table) { $table->id();
            $table->foreignId('estimate_id')->constrained('estimates');
            $table->foreignId('service_id')->constrained('services');
            $table->foreignId('part_id')->constrained('parts');
            $table->integer('quantity');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('estimate_items'); } };