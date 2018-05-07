<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('access_log', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('user_id')->unsigned()->default(0)->index('FK_activities_users_1');
            $table->dateTime('created_at');
            $table->string('action', 50);
            $table->string('module', 50);
            $table->integer('record');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('access_log');
    }
}
