<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fl_drivers', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->string('license_number');
            $table->string('phone')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fl_drivers'); } };