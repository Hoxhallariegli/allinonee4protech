<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_projects', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('client_id')->constrained('ce_clients');
            $table->date('start_date');
            $table->decimal('budget')->nullable();
            $table->enum('status', ['planning', 'active', 'completed']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_projects'); } };