<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_payments', function (Blueprint $table) { $table->id();
            $table->foreignId('order_id')->constrained('rp_orders');
            $table->decimal('amount');
            $table->enum('method', ['cash', 'card']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_payments'); } };