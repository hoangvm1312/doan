<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();


class CafeController extends Controller
{
    public function showKhuvuc(){
        $khuvuc_id=1;
        return Redirect::to('/ban-cafe/'.$khuvuc_id);
    }

    public function showBancafe($khuvuc_id){
        $all_khuvuc=DB::table('tbl_khuvuc')->get();
        $all_bancafe=DB::table('tbl_bancafe')->where('khuvuc_id',$khuvuc_id)->get();    
        $all_bancafe=DB::table('tbl_bancafe')
        ->where('tbl_bancafe.khuvuc_id',$khuvuc_id)
        ->get();
        $loaisanpham_id=DB::table('tbl_loaisanpham')->pluck('loaisanpham_id')->first();
        return view('pages.cafe')->with('all_khuvuc',$all_khuvuc)->with('all_bancafe',$all_bancafe)->with('loaisanpham_id',$loaisanpham_id);
    }    
}


