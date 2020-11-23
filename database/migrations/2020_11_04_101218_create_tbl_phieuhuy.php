<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieuhuy extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieuhuy', function (Blueprint $table) {
            $table->increments('phieuhuy_id');
            $table->text('phieuhuy_nguoi');
            $table->string('phieuhuy_price');
            $table->date('phieuhuy_time');
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
        Schema::dropIfExists('tbl_phieuhuy');
    }
}
