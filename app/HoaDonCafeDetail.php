<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoaDonCafeDetail extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'hoadoncafeDetail_id','sanpham_id','hoadoncafe_id','hoadoncafeDetail_nums','hoadoncafeDetail_price'
    ];
    protected $primaryKey = 'hoadoncafeDetail_id';
    protected $table = 'tbl_hoadoncafeDetail';
}
