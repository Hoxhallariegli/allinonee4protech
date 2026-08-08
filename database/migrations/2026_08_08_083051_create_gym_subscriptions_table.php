<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('gym_subscriptions', function (Blueprint $table) { $table->id();
            $table->foreignId('member_id')->constrained('gym_members');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired', 'cancelled']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('gym_subscriptions'); } };