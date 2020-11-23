<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TongQuan extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('tbl_tongquan')->insert([
            [
            'doanhso' => '14000000',
            'loinhuan' => '10000000',
            'time' => '2020-11-11',
            'tongdon' => '28',
        ],[
            'doanhso' => '10000000',
            'loinhuan' => '5000000',
            'time' => '2020-11-12',
            'tongdon' => '15',
        ],[
            'doanhso' => '9000000',
            'loinhuan' => '6000000',
            'time' => '2020-11-13',
            'tongdon' => '12',
        ],[
            'doanhso' => '14000000',
            'loinhuan' => '13000000',
            'time' => '2020-11-14',
            'tongdon' => '17',
        ],[
            'doanhso' => '24000000',
            'loinhuan' => '16000000',
            'time' => '2020-11-15',
            'tongdon' => '35',
        ],[
            'doanhso' => '32000000',
            'loinhuan' => '27000000',
            'time' => '2020-11-18',
            'tongdon' => '35',
        ],[
            'doanhso' => '9000000',
            'loinhuan' => '7900000',
            'time' => '2020-10-11',
            'tongdon' => '35',
        ],[
            'doanhso' => '22000000',
            'loinhuan' => '20000000',
            'time' => '2020-10-12',
            'tongdon' => '35',
        ],[
            'doanhso' => '16000000',
            'loinhuan' => '15300000',
            'time' => '2020-10-13',
            'tongdon' => '35',
        ]
        ]);
    }
}
