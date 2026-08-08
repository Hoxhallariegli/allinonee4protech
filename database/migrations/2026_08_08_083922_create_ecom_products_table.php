<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ecom_products', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->integer('stock');
            $table->foreignId('vendor_id')->constrained('ecom_vendors');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ecom_products'); } };