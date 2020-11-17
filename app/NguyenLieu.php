<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NguyenLieu extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'nguyenlieu_name','dvt','nguyenlieu_nums','nguyenlieu_price','nguyenlieu_image','nguyenlieu_ngaynhap'
    ];
    protected $primaryKey = 'nguyenlieu_id';
    protected $table = 'tbl_nguyenlieu';
}
