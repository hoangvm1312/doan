<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KhuVuc extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'khuvuc_name'
    ];
    protected $primaryKey = 'khuvuc_id';
    protected $table = 'tbl_khuvuc';
}
