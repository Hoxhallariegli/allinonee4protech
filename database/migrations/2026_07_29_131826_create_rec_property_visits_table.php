<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rec_property_visits', function (Blueprint $table) { $table->id();
            $table->foreignId('property_id')->constrained('rec_properties');
            $table->foreignId('client_id')->constrained('rec_clients');
            $table->datetime('visit_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rec_property_visits'); } };