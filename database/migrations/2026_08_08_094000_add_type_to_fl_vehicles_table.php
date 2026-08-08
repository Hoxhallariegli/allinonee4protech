<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('fl_vehicles', function (Blueprint $table) {
            $table->string('type')->nullable()->after('model');
        });
    }

    public function down()
    {
        Schema::table('fl_vehicles', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
