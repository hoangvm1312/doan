<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPhieuxuatdetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_phieuxuatdetail', function (Blueprint $table) {
            $table->increments('phieuxuatDetail_id');
            $table->integer('phieuxuat_id');
            $table->integer('nguyenlieu_id');
            $table->integer('phieuxuatDetail_nums');
            $table->text('phieuxuatDetail_dvt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_phieuxuatdetail');
    }
}
