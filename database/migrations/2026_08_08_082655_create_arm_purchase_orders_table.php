<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_purchase_orders', function (Blueprint $table) { $table->id();
            $table->foreignId('supplier_id')->constrained('arm_suppliers');
            $table->date('order_date');
            $table->string('status');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_purchase_orders'); } };