<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_order_items', function (Blueprint $table) { $table->id();
            $table->foreignId('order_id')->constrained('rp_orders');
            $table->foreignId('menu_item_id')->constrained('rp_menu_items');
            $table->integer('quantity');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_order_items'); } };