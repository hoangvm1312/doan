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
    public function thongTinKhachHangCafe($hoadoncafe_id){
    	return view('pages.formKhachHang')->with('hoadoncafe_id',$hoadoncafe_id);
    }

    public function saveCongNoCafe(Request $request,$hoadoncafe_id){
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
    	$data_cn['khachhang_id']=$khachhang->khachhang_id;
    	DB::table('tbl_congnocafe')->insert($data_cn);
    	return Redirect::to('/thanh-toan-cafe/'.$hoadoncafe_id);
    }

    //Công nợ karaoke
    public function thongTinKhachHangkaraoke($hoadonkaraoke_id){
        return view('pages.formKhachHang')->with('hoadonkaraoke_id',$hoadonkaraoke_id);
    }

    public function saveCongNokaraoke(Request $request,$hoadonkaraoke_id){
        $data=array();
        $data['khachhang_name']=$request->name;
        $data['khachhang_sdt']=$request->numb;
        DB::table('tbl_khachhang')->insert($data);

        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $khachhang=DB::table('tbl_khachhang')->orderby('khachhang_id','desc')->first();
        $data_cn=array();
        $data_cn['hoadonkaraoke_id']=$hoadonkaraoke_id;
        $data_cn['congnokaraoke_nguoi']='nhanvien';
        $data_cn['congnokaraoke_status']=1;
        $data_cn['congnokaraoke_time']=$time;
        $data_cn['khachhang_id']=$khachhang->khachhang_id;
        DB::table('tbl_congnokaraoke')->insert($data_cn);
        return Redirect::to('/thanh-toan-karaoke/'.$hoadonkaraoke_id);
    }

   /* Trả công nợ*/
    public function timThongTin(){
        return view('pages.formKhachHang');
    }

    public function lietKeCongNo(Request $request){
        

        $khachhang=DB::table('tbl_khachhang')
        ->where('tbl_khachhang.khachhang_sdt',$request->numb)
        ->get();

        $dskhachhangcafe=array();
        foreach($khachhang as $key=>$value){
            $tam1=DB::table('tbl_khachhang') 
            ->where('tbl_khachhang.khachhang_id',$value->khachhang_id)
            ->join('tbl_congnocafe','tbl_congnocafe.khachhang_id','=','tbl_khachhang.khachhang_id')
            ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_congnocafe.hoadoncafe_id')
            ->first();
            array_push($dskhachhangcafe, $tam1);
        }


        $dskhachhangkaraoke=array();
        foreach($khachhang as $key=>$value){
            $tam2=DB::table('tbl_khachhang') 
            ->where('tbl_khachhang.khachhang_id',$value->khachhang_id)
            ->join('tbl_congnokaraoke','tbl_congnokaraoke.khachhang_id','=','tbl_khachhang.khachhang_id')
            ->join('tbl_hoadonkaraoke','tbl_hoadonkaraoke.hoadonkaraoke_id','=','tbl_congnokaraoke.hoadonkaraoke_id')
            ->first();
            array_push($dskhachhangkaraoke, $tam2);
        }

        if(isset($dskhachhangcafe)&&is_null($dskhachhangkaraoke))  
            return view('pages.lietkecongno')->with('khachhang_cafe',$dskhachhangcafe);

        else if(isset($dskhachhangkaraoke)&&is_null($dskhachhangcafe)) 
            return view('pages.lietkecongno')->with('khachhang_karaoke',$dskhachhangkaraoke);
        else
            return view('pages.lietkecongno')->with('khachhang_cafe',$dskhachhangcafe)->with('khachhang_karaoke',$dskhachhangkaraoke);
        
        
    }
}
