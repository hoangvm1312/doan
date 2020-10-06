<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblHoadoncafe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_hoadoncafe', function (Blueprint $table) {
            $table->increments('hoadoncafe_id');
            $table->integer('phieubancafe_id');
            $table->dateTime('hoadoncafe_time');
            $table->text('hoadoncafe_nguoi');
            $table->string('hoadoncafe_price');
            $table->integer('khachhang_id');
            $table->integer('hoadoncafe_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_hoadoncafe');
    }
}
