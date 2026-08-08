<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('event_ticket_types', function (Blueprint $table) { $table->id();
            $table->foreignId('event_id')->constrained('event_events');
            $table->string('name');
            $table->decimal('price');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('event_ticket_types'); } };