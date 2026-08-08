<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hr_payrolls', function (Blueprint $table) { $table->id();
            $table->foreignId('employee_id')->constrained('hr_employees');
            $table->string('month');
            $table->decimal('amount');
            $table->boolean('is_paid')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hr_payrolls'); } };