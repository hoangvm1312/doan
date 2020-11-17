<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phong extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'loaiphong_id','phong_name','phong_status'
    ];
    protected $primaryKey = 'phong_id';
    protected $table = 'tbl_phong';
}
