<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceTabsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_tabs', function (Blueprint $table) {
            $table->unsignedInteger('service_id');
            $table->unsignedInteger('tab_id');
            $table->text('value');

            $table->primary(['service_id', 'tab_id']);

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('tab_id')->references('id')->on('tabs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_tabs');
    }
}
