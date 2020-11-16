<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhieuDenBu extends Model
{
    public $table = "tbl_phieudenbuDetail";
    public $filltable = ['thietbi_name', 'phieudenbu_id', 'phieudenbuDetail_nums', 'phieudenbuDetail_reason', 'phieudenbuDetail_price','phieudenbuDetail_note','phieudenbuDetail_cost'];
}
