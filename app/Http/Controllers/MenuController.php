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
    public function showMenu(){
        $all_sanpham=DB::table('tbl_sanpham')->orderby('sanpham_name','desc')->get();
        return view('pages.menu')->with('all_sanpham',$all_sanpham);
    }
}
