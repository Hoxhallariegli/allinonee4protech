<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_subcontractors', function (Blueprint $table) { $table->id();
            $table->foreignId('project_id')->constrained('ce_projects');
            $table->string('name');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_subcontractors'); } };