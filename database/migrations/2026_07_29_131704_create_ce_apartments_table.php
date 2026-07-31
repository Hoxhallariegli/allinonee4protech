<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_apartments', function (Blueprint $table) { $table->id();
            $table->foreignId('building_id')->constrained('ce_buildings');
            $table->string('number');
            $table->decimal('area')->nullable();
            $table->enum('status', ['available', 'sold', 'reserved']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_apartments'); } };