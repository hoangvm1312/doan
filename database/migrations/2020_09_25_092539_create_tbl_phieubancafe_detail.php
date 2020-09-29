<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieubancafeDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieubancafeDetail', function (Blueprint $table) {
            $table->increments('phieubancafeDetail_id');
            $table->integer('phieubancafe_id');
            $table->integer('sanpham_id');
            $table->integer('phieubancafeDetail_nums');
            $table->string('phieubancafeDetail_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieubancafeDetail');
    }
}
