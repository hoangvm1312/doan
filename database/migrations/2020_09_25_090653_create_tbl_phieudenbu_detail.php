<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieudenbuDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieudenbuDetail', function (Blueprint $table) {
            $table->increments('phieudenbuDetail_id');
            $table->integer('phieudenbu_id');
            $table->text('phieudenbuDetail_thietbi');
            $table->string('phieudenbuDetail_cost');
            $table->integer('phieudenbuDetail_nums');
            $table->text('phieudenbuDetail_reason');
            $table->string('phieudenbuDetail_price');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieudenbuDetail');
    }
}
