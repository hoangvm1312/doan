<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCongnokaraoke extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_congnokaraoke', function (Blueprint $table) {
            $table->increments('congnokaraoke_id');
            $table->integer('hoadonkaraoke_id');
            $table->dateTime('congnokaraoke_timein');
            $table->dateTime('congnokaraoke_timeout');
            $table->text('congnokaraoke_nguoi');
            $table->integer('congnokaraoke_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_connokaraoke');
    }
}
