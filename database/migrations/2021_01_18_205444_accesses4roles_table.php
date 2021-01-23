<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Accesses4rolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesses4roles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('access_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->index(['access_id', 'role_id']);
            $table->foreign('access_id')->references('id')->on('accesses');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesses4roles');
    }
}
