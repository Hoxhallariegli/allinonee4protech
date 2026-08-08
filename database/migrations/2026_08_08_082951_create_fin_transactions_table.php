<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fin_transactions', function (Blueprint $table) { $table->id();
            $table->foreignId('account_id')->constrained('fin_accounts');
            $table->foreignId('category_id')->constrained('fin_categories');
            $table->decimal('amount');
            $table->date('date');
            $table->text('description')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fin_transactions'); } };