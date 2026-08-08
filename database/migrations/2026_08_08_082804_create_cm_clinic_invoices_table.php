<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('cm_clinic_invoices', function (Blueprint $table) { $table->id();
            $table->foreignId('visit_id')->constrained('cm_visits');
            $table->decimal('amount');
            $table->enum('status', ['paid', 'pending']);
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('cm_clinic_invoices'); } };