<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_images', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('catalog_product_id');
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->index(['catalog_product_id']);
            $table->foreign('catalog_product_id')->references('id')->on('catalog_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_product_images');
    }
}
