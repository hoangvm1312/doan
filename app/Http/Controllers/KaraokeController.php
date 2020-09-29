<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class KaraokeController extends Controller
{
    public function showLoaiphong(){
        $all_loaiphong=DB::table('tbl_loaiphong')->get();
        return view('pages.karaoke')->with('all_loaiphong',$all_loaiphong);
    }

    public function showPhongKaraoke($loaiphong_id){
        $all_loaiphong=DB::table('tbl_loaiphong')->get();
        $all_phong=DB::table('tbl_phong')->where('loaiphong_id',$loaiphong_id)->get();
        return view('pages.karaoke')->with('all_loaiphong',$all_loaiphong)->with('all_phong',$all_phong);
    }
}
