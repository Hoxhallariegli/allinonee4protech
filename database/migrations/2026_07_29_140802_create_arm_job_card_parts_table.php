<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_job_card_parts', function (Blueprint $table) { $table->id();
            $table->foreignId('job_card_id')->constrained('arm_job_cards');
            $table->foreignId('part_id')->constrained('arm_parts');
            $table->integer('quantity');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_job_card_parts'); } };