<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('wm_stock_adjustments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('wm_products')->onDelete('cascade');
            $table->foreignId('warehouse_id')->constrained('wm_warehouses')->onDelete('cascade');
            $table->integer('quantity');
            $table->enum('adjustment_type', ['addition', 'subtraction']);
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('wm_stock_adjustments');
    }
};
