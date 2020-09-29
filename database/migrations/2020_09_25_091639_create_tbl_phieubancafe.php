<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieubancafe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieubancafe', function (Blueprint $table) {
            $table->increments('phieubancafe_id');
            $table->integer('bancafe_id');
            $table->date('phieubancafe_time');
            $table->text('phieubancafe_nguoi');
            $table->string('phieubancafe_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieubancafe');
    }
}
