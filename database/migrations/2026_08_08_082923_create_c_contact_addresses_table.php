<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('c_contact_addresses', function (Blueprint $table) { $table->id();
            $table->foreignId('contact_id')->constrained('c_contacts');
            $table->string('address');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('c_contact_addresses'); } };