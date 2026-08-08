<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_customer_addresses', function (Blueprint $table) { $table->id();
            $table->foreignId('customer_id')->constrained('arm_customers');
            $table->string('address');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_customer_addresses'); } };