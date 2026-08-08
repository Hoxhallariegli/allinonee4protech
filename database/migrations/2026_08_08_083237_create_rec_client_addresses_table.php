<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('rec_client_addresses', function (Blueprint $table) { $table->id();
            $table->foreignId('client_id')->constrained('rec_clients');
            $table->string('address');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('rec_client_addresses'); } };