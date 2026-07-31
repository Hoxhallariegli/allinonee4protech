<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('wm_stock_transfers', function (Blueprint $table) { $table->id();
            $table->foreignId('product_id')->constrained('wm_products');
            $table->foreignId('from_warehouse_id')->constrained('wm_warehouses');
            $table->foreignId('to_warehouse_id')->constrained('wm_warehouses');
            $table->integer('quantity');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('wm_stock_transfers'); } };