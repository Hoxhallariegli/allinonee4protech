<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rp_dining_tables', function (Blueprint $table) { $table->id();
            $table->string('number');
            $table->integer('capacity')->nullable();
            $table->enum('status', ['free', 'occupied']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rp_dining_tables'); } };