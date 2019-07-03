<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOurServiceItemImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_service_item_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('our_service_item_id');
            $table->string('name', 255)->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->char('basename', 40);
            $table->string('ext', 5);
            $table->enum('is_published', [0,1])->default(1);
            $table->unsignedSmallInteger('pos')->default(0);

            $table->foreign('our_service_item_id')->references('id')->on('our_service_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_service_item_images');
    }
}
