<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('agri_inventory_supplies', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->integer('stock_quantity');
            $table->string('unit');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('agri_inventory_supplies'); } };