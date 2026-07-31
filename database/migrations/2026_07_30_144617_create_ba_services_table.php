<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ba_services', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->integer('duration_minutes');
            $table->decimal('price');
            $table->boolean('active');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ba_services'); } };