<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_purchase_order_items', function (Blueprint $table) { $table->id();
            $table->foreignId('purchase_order_id')->constrained('arm_purchase_orders');
            $table->foreignId('part_id')->constrained('arm_parts');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_purchase_order_items'); } };