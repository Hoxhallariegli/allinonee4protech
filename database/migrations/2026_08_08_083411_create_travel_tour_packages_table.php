<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('travel_tour_packages', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('destination_id')->constrained('travel_destinations');
            $table->decimal('price');
            $table->integer('duration_days');
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('travel_tour_packages'); } };