<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('middlename');
            $table->string('email')->unique();
            $table->string('mobile_phone', 16)->unique();
            $table->string('time2call')->default('');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->index(['email', 'password']);
        });

        \DB::unprepared("
            DROP TYPE IF EXISTS user_status;
            CREATE TYPE user_status AS ENUM ('blocked', 'active', 'wait');
            ALTER TABLE users
                ADD COLUMN status user_status DEFAULT 'wait';
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
