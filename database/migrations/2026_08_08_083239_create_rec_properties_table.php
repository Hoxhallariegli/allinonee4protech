<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rec_properties', function (Blueprint $table) { $table->id();
            $table->string('title');
            $table->foreignId('owner_id')->constrained('rec_owners');
            $table->foreignId('agent_id')->constrained('rec_agents');
            $table->decimal('price');
            $table->enum('type', ['apartment', 'house', 'land']);
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rec_properties'); } };