<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserVisitsTable extends Migration
{
    public function up()
    {
        Schema::create('user_visits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('circle_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('visit_status_id');
            $table->date('programmed_date');
            $table->time('programmed_time');
            $table->date('arrival_date');
            $table->time('arrival_time');
            $table->longText('route');
            $table->string('detail');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::table('user_visits', function (Blueprint $table) {
            $table->foreign('circle_id')->references('id')->on('circles');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('visit_status_id')->references('id')->on('visit_statuses');
        });
    }
    public function down()
    {
        Schema::drop('user_visits');
    }
}
