<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('purchase_order_items', function (Blueprint $table) { $table->id();
            $table->foreignId('purchase_order_id')->constrained('purchase_orders');
            $table->foreignId('part_id')->constrained('parts');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('purchase_order_items'); } };