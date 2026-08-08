<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('legal_legal_cases', function (Blueprint $table) { $table->id();
            $table->string('title');
            $table->foreignId('client_id')->constrained('legal_clients');
            $table->enum('status', ['open', 'closed', 'appealed']);
            $table->text('description')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('legal_legal_cases'); } };