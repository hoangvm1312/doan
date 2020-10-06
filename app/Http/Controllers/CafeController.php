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
        /*$all_khuvuc=DB::table('tbl_khuvuc')->get();
        return view('pages.cafe')->with('all_khuvuc',$all_khuvuc);*/
        $khuvuc_id=1;
        $all_khuvuc=DB::table('tbl_khuvuc')->get();
        $all_bancafe=DB::table('tbl_bancafe')->where('khuvuc_id',$khuvuc_id)->get();
        return view('pages.cafe')->with('all_khuvuc',$all_khuvuc)->with('all_bancafe',$all_bancafe);
    }

    public function showBancafe($khuvuc_id){
        $all_khuvuc=DB::table('tbl_khuvuc')->get();
        $all_bancafe=DB::table('tbl_bancafe')->where('khuvuc_id',$khuvuc_id)->get();
        return view('pages.cafe')->with('all_khuvuc',$all_khuvuc)->with('all_bancafe',$all_bancafe);
    }

    public function selectProduct($bancafe_id){
        $loaisanpham_id=1;
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham);
    }
}


