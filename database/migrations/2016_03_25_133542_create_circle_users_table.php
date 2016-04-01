<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCircleUsersTable extends Migration
{
    public function up()
    {
        Schema::create('circle_users', function (Blueprint $table) {
            $table->integer('circle_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('circle_id')->references('id')->on('circles');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary(['circle_id', 'user_id']);
        });
    }
    public function down()
    {
        Schema::drop('circle_users');
    }
}
