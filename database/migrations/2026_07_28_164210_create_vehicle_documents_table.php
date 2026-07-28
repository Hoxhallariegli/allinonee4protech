<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('vehicle_documents', function (Blueprint $table) { $table->id();
            $table->string('type');
            $table->string('document');
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('vehicle_documents'); } };