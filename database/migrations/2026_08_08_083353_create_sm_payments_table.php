<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('sm_payments', function (Blueprint $table) { $table->id();
            $table->foreignId('student_id')->constrained('sm_students');
            $table->decimal('amount');
            $table->date('payment_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('sm_payments'); } };