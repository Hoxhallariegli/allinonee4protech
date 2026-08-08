<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('rec_properties', function (Blueprint $table) {
            $table->string('listing_type')->nullable()->after('type'); // e.g., 'Sale', 'Rent'
        });
    }

    public function down()
    {
        Schema::table('rec_properties', function (Blueprint $table) {
            $table->dropColumn('listing_type');
        });
    }
};
