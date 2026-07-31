<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_contracts', function (Blueprint $table) { $table->id();
            $table->foreignId('project_id')->constrained('ce_projects');
            $table->foreignId('client_id')->constrained('ce_clients');
            $table->date('contract_date');
            $table->decimal('amount');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_contracts'); } };