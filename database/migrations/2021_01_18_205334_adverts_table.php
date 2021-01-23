<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdvertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('category_id')->index();
            $table->bigInteger('user_id')->index();
            $table->bigInteger('city_id')->index();
            $table->string('title');
            $table->longText('description')->default('');
            $table->integer('status')->default(0)->index();
            $table->integer('cost')->default(1);
            $table->date('publish_date')->nullable();
            $table->integer('views_amount')->default(0);
            $table->json('photos')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('ad_categories');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('city_id')->references('id')->on('dic_cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
}
