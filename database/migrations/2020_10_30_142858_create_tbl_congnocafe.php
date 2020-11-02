<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCongnocafe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_congnocafe', function (Blueprint $table) {
            $table->increments('congnocafe_id');
            $table->integer('hoadoncafe_id');
            $table->dateTime('congnocafe_timein');
            $table->dateTime('congnocafe_timeout');
            $table->text('congnocafe_nguoi');
            $table->integer('congnocafe_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_connocafe');
    }
}
