<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblNguyenlieu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_nguyenlieu', function (Blueprint $table) {
            $table->increments('nguyenlieu_id');
            $table->text('nguyenlieu_name');
            $table->text('dvt');
            $table->string('nguyenlieu_nums');
            $table->string('nguyenlieu_price');
            $table->text('nguyenlieu_image');
            $table->date('nguyenlieu_ngaynhap');
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
        Schema::dropIfExists('tbl_nguyenlieu');
    }
}
