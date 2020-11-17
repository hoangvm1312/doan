<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BanCafe extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'bancafe_name','bancafe_status','khuvuc_id'
    ];
    protected $primaryKey = 'bancafe_id';
    protected $table = 'tbl_bancafe';
}
