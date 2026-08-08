<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('event_events', function (Blueprint $table) { $table->id();
            $table->string('title');
            $table->foreignId('organizer_id')->constrained('event_organizers');
            $table->datetime('event_date');
            $table->string('location')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('event_events'); } };