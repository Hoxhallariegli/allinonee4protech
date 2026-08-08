<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_expense_trackings', function (Blueprint $table) { $table->id();
            $table->text('description');
            $table->decimal('amount');
            $table->date('date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_expense_trackings'); } };