<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up() { Schema::create('ce_progress_reports', function (Blueprint $table) { $table->id();
            $table->foreignId('project_id')->constrained('ce_projects');
            $table->date('report_date');
            $table->integer('percentage');
            $table->timestamps(); }); } public function down() { Schema::dropIfExists('ce_progress_reports'); } };