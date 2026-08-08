<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_payments', function (Blueprint $table) { $table->id();
            $table->foreignId('client_id')->constrained('ce_clients');
            $table->decimal('amount');
            $table->date('payment_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_payments'); } };