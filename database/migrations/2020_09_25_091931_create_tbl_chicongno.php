<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblChicongno extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_chicongno', function (Blueprint $table) {
            $table->increments('chicognno_id');
            $table->dateTime('chicongno_time');
            $table->text('chicongno_nguoi');
            $table->string('chicongno_price');
            $table->integer('phieuthue_id');
            $table->integer('chicongno_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_chicongno');
    }
}
