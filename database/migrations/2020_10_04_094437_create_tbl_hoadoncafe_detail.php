<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHoadoncafeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hoadoncafeDetail', function (Blueprint $table) {
            $table->increments('hoadoncafeDetail_id');
            $table->integer('hoadoncafe_id');
            $table->integer('sanpham_id');
            $table->integer('hoadoncafeDetail_nums');
            $table->string('hoadoncafeDetail_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hoadoncafeDetail');
    }
}
