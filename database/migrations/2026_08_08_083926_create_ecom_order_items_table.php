<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ecom_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('ecom_orders')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('ecom_products')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 12, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ecom_order_items');
    }
};
