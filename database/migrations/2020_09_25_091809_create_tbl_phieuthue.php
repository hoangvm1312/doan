<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieuthue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieuthue', function (Blueprint $table) {
            $table->increments('phieuthue_id');
            $table->integer('phong_id');
            $table->dateTime('phieuthue_timein');
            $table->dateTime('phieuthue_timeout');
            $table->text('phieuthue_nguoi');
            $table->string('phieuthue_price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieuthue');
    }
}
