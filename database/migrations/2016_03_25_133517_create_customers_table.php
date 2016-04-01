<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identification')->unique();
            $table->string('name');
            $table->string('address');
            $table->string('reference');
            $table->decimal('latitude', 10, 5);
            $table->decimal('longitude', 10, 5);
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down()
    {
        Schema::drop('customers');
    }
}
