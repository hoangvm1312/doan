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

        $all_hoadon=DB::table('tbl_hoadoncafeDetail')
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadoncafeDetail.sanpham_id')
        ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_hoadoncafeDetail.hoadoncafe_id')
        ->where('bancafe_id',$bancafe_id)
        ->get();
    	

        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham)
        ->with('all_hoadon',$all_hoadon);
    }

    public function plusProduct($sanpham_id,$hoadoncafe_id){
    	$product=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->first();
        $i=$product->hoadoncafeDetail_nums+1;

    	DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->update(['hoadoncafeDetail_nums'=>$i]);
    	$bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        /* return view('/cafe-select-product')->with(compact('bancafe_id'));*/
        /*return Redirect()->action('BillController@showBill',['bancafe_id'=>$bancafe_id]);*/
    	return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function minusProduct($sanpham_id){
    	
    }

    public function deleteProduct($sanpham_id){
    	
    }
}
