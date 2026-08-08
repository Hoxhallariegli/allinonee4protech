<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_menu_items', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->string('category')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_menu_items'); } };