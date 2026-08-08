<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('legal_billings', function (Blueprint $table) { $table->id();
            $table->foreignId('case_id')->constrained('legal_legal_cases');
            $table->decimal('amount');
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('legal_billings'); } };