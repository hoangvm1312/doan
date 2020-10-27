<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHoadonkaraoke extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hoadonkaraoke', function (Blueprint $table) {
            $table->increments('hoadonkaraoke_id');
            $table->integer('phong_id');
            $table->dateTime('hoadonkaraoke_timein');
            $table->dateTime('hoadonkaraoke_timeout');
            $table->text('hoadonkaraoke_nguoi');
            $table->string('hoadonkaraoke_price');
            $table->integer('khachhang_id');
            $table->integer('hoadonkaraoke_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hoadonkaraoke');
    }
}
