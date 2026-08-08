<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_payments', function (Blueprint $table) { $table->id();
            $table->foreignId('patient_id')->constrained('cm_patients');
            $table->foreignId('invoice_id')->constrained('cm_clinic_invoices')->nullable();
            $table->decimal('amount');
            $table->enum('payment_method', ['cash', 'card', 'insurance']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_payments'); } };