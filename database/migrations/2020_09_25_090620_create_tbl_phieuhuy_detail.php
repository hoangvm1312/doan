<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieuhuyDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieuhuyDetail', function (Blueprint $table) {
            $table->increments('phieuhuyDetail_id');
            $table->integer('phieuhuy_id'); 
            $table->integer('sanpham_id'); 
            $table->string('phieuhuyDetail_cost'); 
            $table->integer('phieuhuyDetail_nums'); 
            $table->text('phieuhuyDetail_reason'); 
            $table->string('phieuhuyDetail_price'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieuhuyDetail');
    }
}
