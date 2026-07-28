<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('job_cards', function (Blueprint $table) { $table->id();
            $table->foreignId('vehicle_id')->constrained('vehicles');
            $table->foreignId('customer_id')->constrained('customers');
            $table->foreignId('mechanic_id')->constrained('mechanics');
            $table->string('status');
            $table->datetime('opened_at')->nullable();
            $table->datetime('closed_at')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('job_cards'); } };