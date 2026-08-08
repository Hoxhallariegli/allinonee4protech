<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('travel_tour_bookings', function (Blueprint $table) { $table->id();
            $table->foreignId('client_id')->constrained('travel_clients');
            $table->foreignId('tour_package_id')->constrained('travel_tour_packages');
            $table->date('booking_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('travel_tour_bookings'); } };