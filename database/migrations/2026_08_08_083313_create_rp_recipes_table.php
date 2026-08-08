<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_recipes', function (Blueprint $table) { $table->id();
            $table->foreignId('menu_item_id')->constrained('rp_menu_items');
            $table->foreignId('ingredient_id')->constrained('rp_ingredients');
            $table->decimal('quantity_required');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_recipes'); } };