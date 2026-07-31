<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('5arm_inventories', function (Blueprint $table) { $table->id();
            $table->foreignId('part_id')->constrained('5arm_parts');
            $table->integer('quantity');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('5arm_inventories'); } };