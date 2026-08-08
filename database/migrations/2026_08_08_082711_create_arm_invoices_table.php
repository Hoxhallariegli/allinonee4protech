<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('arm_invoices', function (Blueprint $table) { $table->id();
            $table->foreignId('job_card_id')->constrained('arm_job_cards');
            $table->date('invoice_date');
            $table->decimal('total');
            $table->string('status');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('arm_invoices'); } };