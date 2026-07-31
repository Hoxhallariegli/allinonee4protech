<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('c_deals', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('contact_id')->constrained('c_contacts');
            $table->decimal('value');
            $table->enum('stage', ['prospecting', 'negotiation', 'won', 'lost']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('c_deals'); } };