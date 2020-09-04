<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAddressToCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->string('address', 512)->nullable()->after('props');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalog_products', function (Blueprint $table) {
            $table->dropColumn(['address']);
        });
    }
}
