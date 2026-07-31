<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_purchase_orders', function (Blueprint $table) { $table->id();
            $table->foreignId('supplier_id')->constrained('ce_suppliers');
            $table->foreignId('project_id')->constrained('ce_projects');
            $table->date('order_date');
            $table->enum('status', ['pending', 'delivered']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_purchase_orders'); } };