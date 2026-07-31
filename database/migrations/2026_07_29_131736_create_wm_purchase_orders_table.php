<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('wm_purchase_orders', function (Blueprint $table) { $table->id();
            $table->foreignId('supplier_id')->constrained('wm_suppliers');
            $table->date('order_date');
            $table->enum('status', ['pending', 'received', 'cancelled']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('wm_purchase_orders'); } };