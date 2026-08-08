<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('legal_hearings', function (Blueprint $table) {
            $table->renameColumn('case_id', 'legal_case_id');
            $table->renameColumn('hearing_date', 'date');
            $table->text('description')->nullable()->after('location');
        });
    }

    public function down()
    {
        Schema::table('legal_hearings', function (Blueprint $table) {
            $table->renameColumn('legal_case_id', 'case_id');
            $table->renameColumn('date', 'hearing_date');
            $table->dropColumn('description');
        });
    }
};
