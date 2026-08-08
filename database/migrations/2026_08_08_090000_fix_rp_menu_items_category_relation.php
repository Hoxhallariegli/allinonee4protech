<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up()
    {
        // SQLite doesn't support renaming columns with foreign keys easily in old versions,
        // but here we are just changing a string column to an integer column.

        Schema::table('rp_menu_items', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('price');
        });

        // If there are existing string categories, we might want to try to map them,
        // but since this is a dev environment and we have only 7 records, we can just clear it or let it be null.

        Schema::table('rp_menu_items', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down()
    {
        Schema::table('rp_menu_items', function (Blueprint $table) {
            $table->string('category')->nullable()->after('price');
            $table->dropColumn('category_id');
        });
    }
};
