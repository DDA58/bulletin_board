<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ad_categories', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->index();
            $table->string('title');
            $table->string('description')->default('');
            $table->integer('parent_id')->default(0)->index();
            $table->integer('order_num')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ad_categories');
    }
}
