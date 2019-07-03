<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOurServiceItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_service_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('our_service_id');
            $table->string('name', 512);
            $table->string('title', 512);
            $table->string('description', 512);
            $table->text('text')->nullable();
            $table->string('alias', 64)->unique();

            $table->foreign('our_service_id')->references('id')->on('our_services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('our_service_items');
    }
}
