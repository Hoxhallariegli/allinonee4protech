<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hr_attendances', function (Blueprint $table) { $table->id();
            $table->foreignId('employee_id')->constrained('hr_employees');
            $table->date('date');
            $table->datetime('clock_in')->nullable();
            $table->datetime('clock_out')->nullable();
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hr_attendances'); } };