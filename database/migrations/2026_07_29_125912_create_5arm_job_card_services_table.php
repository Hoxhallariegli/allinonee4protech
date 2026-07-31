<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('5arm_job_card_services', function (Blueprint $table) { $table->id();
            $table->foreignId('job_card_id')->constrained('5arm_job_cards');
            $table->foreignId('service_id')->constrained('5arm_services');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('5arm_job_card_services'); } };