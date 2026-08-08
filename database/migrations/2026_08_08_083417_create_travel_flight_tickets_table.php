<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('travel_flight_tickets', function (Blueprint $table) { $table->id();
            $table->foreignId('client_id')->constrained('travel_clients');
            $table->string('flight_number');
            $table->datetime('departure_date');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('travel_flight_tickets'); } };