<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHoadonkaraokeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hoadonkaraokeDetail', function (Blueprint $table) {
            $table->increments('hoadonkaraokeDetail_id');
            $table->integer('hoadonkaraoke_id');
            $table->integer('sanpham_id');
            $table->integer('hoadonkaraokeDetail_nums');
            $table->string('hoadonkaraokeDetail_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hoadonkaraokeDetail');
    }
}
