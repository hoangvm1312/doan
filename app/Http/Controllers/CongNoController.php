<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class CongNoController extends Controller
{
    //Công nợ cafe
    public function thongTinKhachHang($hoadoncafe_id){
    	return view('pages.formKhachHang')->with('hoadoncafe_id',$hoadoncafe_id);
    }

    public function saveCongNo(Request $request,$hoadoncafe_id){
    	$data=array();
    	$data['khachhang_name']=$request->name;
    	$data['khachhang_sdt']=$request->numb;
    	DB::table('tbl_khachhang')->insert($data);

    	$time=Carbon::now('Asia/Ho_Chi_Minh');
    	$khachhang=DB::table('tbl_khachhang')->orderby('khachhang_id','desc')->first();
    	$data_cn=array();
    	$data_cn['hoadoncafe_id']=$hoadoncafe_id;
    	$data_cn['congnocafe_nguoi']='nhanvien';
    	$data_cn['congnocafe_status']=1;
    	$data_cn['congnocafe_time']=$time;
    	$data_cn['khachhang_sdt']=$khachhang->khachhang_sdt;
    	DB::table('tbl_congnocafe')->insert($data_cn);

    	return Redirect::to('/thanh-toan-cafe/'.$hoadoncafe_id);
    	
    }

   /* Trả công nợ*/
    public function timThongTin(){
        return view('pages.formKhachHang');
    }

    public function lietKeCongNo(Request $request){
        $khachhang_cafe=DB::table('tbl_khachhang')
        ->where('tbl_khachhang.khachhang_sdt',$request->numb)
        ->join('tbl_congnocafe','tbl_congnocafe.khachhang_sdt','=','tbl_khachhang.khachhang_sdt')
        ->where('tbl_congnocafe.congnocafe_status','1')
        ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_congnocafe.hoadoncafe_id')
        ->get();

        $khachhang_karaoke=DB::table('tbl_khachhang')
        ->where('tbl_khachhang.khachhang_sdt',$request->numb)
        ->join('tbl_congnokaraoke','tbl_congnokaraoke.khachhang_sdt','=','tbl_khachhang.khachhang_sdt')
        ->where('tbl_congnokaraoke.congnokaraoke_status','1')
        ->join('tbl_hoadonkaraoke','tbl_hoadonkaraoke.hoadonkaraoke_id','=','tbl_congnokaraoke.hoadonkaraoke_id')
        ->get();
        
        return view('pages.lietkecongno')->with('khachhang_cafe',$khachhang_cafe)->with('khachhang_karaoke',$khachhang_karaoke);
        
    }
}
