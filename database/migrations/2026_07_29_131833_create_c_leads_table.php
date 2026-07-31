<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('c_leads', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('company_id')->constrained('c_companies');
            $table->string('source')->nullable();
            $table->enum('status', ['new', 'contacted', 'qualified']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('c_leads'); } };