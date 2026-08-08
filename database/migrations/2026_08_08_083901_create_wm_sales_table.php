<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('wm_sales', function (Blueprint $table) { $table->id();
            $table->foreignId('customer_id')->constrained('wm_customers');
            $table->date('sale_date');
            $table->decimal('total');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('wm_sales'); } };