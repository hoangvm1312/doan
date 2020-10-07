<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class BillController extends Controller
{
    public function showBill($bancafe_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')->where('loaisanpham_id','1')->get();

        $all_hoadon=DB::table('tbl_hoadoncafe')
        ->join('tbl_hoadoncafeDetail','tbl_hoadoncafeDetail.hoadoncafe_id','=','tbl_hoadoncafe.hoadoncafe_id')
        ->where('tbl_hoadoncafe.hoadoncafe_status','1')
        ->where('tbl_hoadoncafe.bancafe_id',$bancafe_id)
        ->get();
    	

        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham)
        ->with('$all_hoadon',$all_hoadon);
    }
}
