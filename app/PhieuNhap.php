<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuNhap extends Model
{
    public $table = "tbl_phieunhapdetail";
    public $filltable = ['nguyenlieu_id', 'phieunhap_id', 'phieunhapDetail_nums', 'phieunhapDetail_dvt', 'phieunhapDetail_cost','phieunhapDetail_price'];
}
