<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('estimates', function (Blueprint $table) { $table->id();
            $table->foreignId('job_card_id')->constrained('job_cards');
            $table->date('estimate_date');
            $table->string('status');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('estimates'); } };