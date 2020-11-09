<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuHuy extends Model
{
    public $table = "tbl_phieuhuydetail";
    public $filltable = ['nguyenlieu_id', 'phieuhuy_id', 'phieuhuyDetail_nums', 'phieuhuyDetail_dvt', 'phieuhuyDetail_cost','phieuhuyDetail_price'];
}
