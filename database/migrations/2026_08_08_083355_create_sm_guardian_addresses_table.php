<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_guardian_addresses', function (Blueprint $table) { $table->id();
            $table->foreignId('guardian_id')->constrained('sm_guardians');
            $table->string('line1');
            $table->string('city')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_guardian_addresses'); } };