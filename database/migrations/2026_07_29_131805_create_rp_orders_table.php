<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_orders', function (Blueprint $table) { $table->id();
            $table->foreignId('table_id')->constrained('rp_dining_tables');
            $table->foreignId('waiter_id')->constrained('rp_waiters');
            $table->datetime('order_date');
            $table->enum('status', ['pending', 'ready', 'paid']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_orders'); } };