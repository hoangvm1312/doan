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
        $loaisanpham_id=1;
        return Redirect::to('/menu-sanpham/'.$loaisanpham_id);
    }
    
    public function showMenu($loaisanpham_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham);
    }
    public function showLoaispTable($loaisanpham_id,$ban_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        return Redirect::to('/cafe-select-product/'.$ban_id.'/'.$loaisanpham_id);
    }
}
