<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('c_contacts', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->foreignId('company_id')->constrained('c_companies');
            $table->string('email')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('c_contacts'); } };