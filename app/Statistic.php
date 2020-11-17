<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
        public $timestamps = false;
        protected $fillable = [
            'doanhso','loinhuan','time','tongdon'
        ];
        protected $primaryKey = 'tongquan_id';
        protected $table = 'tbl_tongquan';
}
