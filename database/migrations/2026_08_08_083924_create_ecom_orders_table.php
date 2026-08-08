<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ecom_orders', function (Blueprint $table) { $table->id();
            $table->foreignId('customer_id')->constrained('ecom_customers');
            $table->decimal('total');
            $table->enum('status', ['pending', 'shipped', 'delivered']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ecom_orders'); } };