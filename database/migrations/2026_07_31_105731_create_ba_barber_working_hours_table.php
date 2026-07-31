<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ba_barber_working_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barber_id')->constrained('ba_barbers')->onDelete('cascade');
            $table->unsignedTinyInteger('day_of_week'); // 0 (Sunday) to 6 (Saturday)
            $table->time('start_time')->default('09:00');
            $table->time('end_time')->default('19:00');
            $table->boolean('is_off')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ba_barber_working_hours');
    }
};
