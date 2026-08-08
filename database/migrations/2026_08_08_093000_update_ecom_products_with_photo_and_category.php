<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('ecom_categories')) {
            Schema::create('ecom_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });
        }

        Schema::table('ecom_products', function (Blueprint $table) {
            if (!Schema::hasColumn('ecom_products', 'photo')) {
                $table->string('photo')->nullable()->after('name');
            }
            if (!Schema::hasColumn('ecom_products', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('vendor_id');
            }
        });
    }

    public function down()
    {
        Schema::table('ecom_products', function (Blueprint $table) {
            $table->dropColumn(['photo', 'category_id']);
        });
        Schema::dropIfExists('ecom_categories');
    }
};
