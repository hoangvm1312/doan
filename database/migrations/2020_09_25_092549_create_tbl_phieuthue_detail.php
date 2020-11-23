<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieuthueDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieuthueDetail', function (Blueprint $table) {
            $table->increments('phieuthueDetail_id');
            $table->integer('phieuthue_id');
            $table->integer('sanpham_id');
            $table->integer('phong_id');
            $table->integer('phieuthueDetail_nums');
            $table->string('phieuthueDetail_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieuthueDetail');
    }
}
