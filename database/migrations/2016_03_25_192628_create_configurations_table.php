<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration
{
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('installed');
            $table->foreign('user_id')->references('id')->on('users');
            $table->primary('id');
        });
    }
    public function down()
    {
        Schema::drop('configurations');
    }
}
