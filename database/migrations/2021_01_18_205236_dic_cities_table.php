<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DicCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dic_cities', function (Blueprint $table) {
            $table->id();
            $table->integer('region_id')->insigned()->index();
            $table->string('name');
            $table->string('slug');
            $table->timestamps();
            //$table->softDeletes();
            $table->foreign('region_id')->references('id')->on('dic_regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dic_cities');
    }
}
