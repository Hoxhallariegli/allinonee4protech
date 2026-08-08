<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('hr_leave_requests', function (Blueprint $table) { $table->id();
            $table->foreignId('employee_id')->constrained('hr_employees');
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['pending', 'approved', 'rejected']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('hr_leave_requests'); } };