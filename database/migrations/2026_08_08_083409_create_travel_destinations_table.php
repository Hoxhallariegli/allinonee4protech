<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('travel_destinations', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->string('country');
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('travel_destinations'); } };