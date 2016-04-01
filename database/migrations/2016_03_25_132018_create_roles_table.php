<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->primary('id');
        });
    }
    public function down()
    {
        Schema::drop('roles');
    }
}
