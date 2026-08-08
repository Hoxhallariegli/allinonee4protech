<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fin_accounts', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->string('type');
            $table->decimal('balance');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fin_accounts'); } };