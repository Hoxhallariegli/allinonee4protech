<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void { Schema::create('sales', function (Blueprint $table) { $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('product_id')->constrained('products');
            $table->integer('quantity');
            $table->decimal('total_price');
            $table->date('sale_date');
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->text('notes')->nullable();
            $table->string('no');
            $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('sales'); }
};