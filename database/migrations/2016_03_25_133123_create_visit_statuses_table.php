<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitStatusesTable extends Migration
{
    public function up()
    {
        Schema::create('visit_statuses', function (Blueprint $table) {
            $table->integer('id');
            $table->string('name')->unique();
            $table->string('description');
            $table->primary('id');
        });
    }
    public function down()
    {
        Schema::drop('visit_statuses');
    }
}
