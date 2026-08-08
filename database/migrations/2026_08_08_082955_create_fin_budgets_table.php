<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('fin_budgets', function (Blueprint $table) { $table->id();
            $table->foreignId('category_id')->constrained('fin_categories');
            $table->decimal('amount');
            $table->string('period');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('fin_budgets'); } };