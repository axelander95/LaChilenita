<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('installed');
            $table->primary('id');
        });
        Schema::table('configurations', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }
    public function down()
    {
        Schema::drop('configurations');
    }
}
