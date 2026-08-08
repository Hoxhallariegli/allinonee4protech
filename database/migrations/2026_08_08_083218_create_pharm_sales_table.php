<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('pharm_sales', function (Blueprint $table) { $table->id();
            $table->decimal('total_amount');
            $table->date('sale_date');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('pharm_sales'); } };