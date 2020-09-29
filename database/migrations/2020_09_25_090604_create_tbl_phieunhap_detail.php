<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieunhapDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieunhapDetail', function (Blueprint $table) {
            $table->increments('phieunhapDetail_id');
            $table->integer('phieunhap_id');   
            $table->integer('sanpham_id'); 
            $table->string('phieunhapDetail_cost');
            $table->integer('phieunhap_nums');  
            $table->string('phieunhapDetail_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieunhapDetail');
    }
}
