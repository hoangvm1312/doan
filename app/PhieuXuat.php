<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuXuat extends Model
{
    public $table = "tbl_phieuxuatdetail";
    public $filltable = ['phieuxuat_id','nguyenlieu_id','phieuxuatDetail_nums','phieunhapDetail_dvt','phieunhapDetail_hsx','phieunhapDetail_hsd','sanpham_id','phieuxuatDetail_numsp'];
}
