<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ba_bookings', function (Blueprint $table) {
            $table->foreignId('customer_id')->nullable()->after('service_id')->constrained('ba_customers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('ba_bookings', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};
