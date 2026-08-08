<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('legal_hearings', function (Blueprint $table) { $table->id();
            $table->foreignId('case_id')->constrained('legal_legal_cases');
            $table->datetime('hearing_date');
            $table->string('location')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('legal_hearings'); } };