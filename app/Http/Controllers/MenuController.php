<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class MenuController extends Controller
{
    public function showLoaisp(){
        /*$all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham);*/
        $loaisanpham_id=1;
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham);
    }
    public function showMenu($loaisanpham_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham);
    }
}
