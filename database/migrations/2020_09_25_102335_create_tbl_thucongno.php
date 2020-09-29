<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblThucongno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_thucongno', function (Blueprint $table) {
            $table->increments('thucognno_id');
            $table->dateTime('thucongno_time');
            $table->text('thucongno_nguoi');
            $table->integer('chicongno_id');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_thucongno');
    }
}
