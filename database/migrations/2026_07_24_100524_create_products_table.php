<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void { Schema::create('products', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('category_id')->constrained('categories');
            $table->decimal('price');
            $table->integer('quantity');
            $table->string('no');
            $table->timestamps(); }); }
    public function down(): void { Schema::dropIfExists('products'); }
};