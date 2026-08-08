<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('gym_membership_plans', function (Blueprint $table) { $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->integer('duration_days');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('gym_membership_plans'); } };