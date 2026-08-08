<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('legal_legal_cases', function (Blueprint $table) {
            $table->string('case_number')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('legal_legal_cases', function (Blueprint $table) {
            $table->dropColumn('case_number');
        });
    }
};
