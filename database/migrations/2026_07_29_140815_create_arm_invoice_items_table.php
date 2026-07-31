<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_invoice_items', function (Blueprint $table) { $table->id();
            $table->foreignId('invoice_id')->constrained('arm_invoices');
            $table->foreignId('service_id')->constrained('arm_services');
            $table->foreignId('part_id')->constrained('arm_parts');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_invoice_items'); } };