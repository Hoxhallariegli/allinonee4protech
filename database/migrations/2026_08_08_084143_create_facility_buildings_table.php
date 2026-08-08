<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('facility_buildings', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('facility_buildings'); } };