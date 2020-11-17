<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuXuat extends Model
{
    public $table = "tbl_phieuxuatdetail";
    public $filltable = ['phieuxuat_id','nguyenlieu_id','phieuxuatDetail_nums','phieuxuatDetail_dvt'];
}
