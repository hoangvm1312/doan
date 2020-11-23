<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblTongquan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tongquan', function (Blueprint $table) {

            $table->increments('tongquan_id');
            $table->integer('doanhso');
            $table->integer('loinhuan');
            $table->date('time');
            $table->integer('tongdon');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_tongquan');
    }
}
