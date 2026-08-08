<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fl_vehicles', function (Blueprint $table) { $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('license_plate');
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fl_vehicles'); } };