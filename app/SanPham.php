<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'sanpham_name','loaisanpham_id','dvt_id','sanpham_image'
    ];
    protected $primaryKey = 'sanpham_id';
    protected $table = 'tbl_sanpham';
}
