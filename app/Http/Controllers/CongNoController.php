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
        //đang không lấy được tên +sđt từ formKhachHang sang
        $data=array();
        $data['khachhang_name']=$request->namek;
        $data['khachhang_sdt']=$request->numbk;
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

        $loaiphong_id=DB::table('tbl_hoadonkaraoke')
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_phong','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
        ->join('tbl_loaiphong','tbl_loaiphong.loaiphong_id','=','tbl_phong.loaiphong_id')
        ->pluck('tbl_loaiphong.loaiphong_id')->first();


        return Redirect::to('/check-out-karaoke/'.$hoadonkaraoke_id.'/'.$loaiphong_id);
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
            ->where('tbl_congnocafe.congnocafe_status',1)
            ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_congnocafe.hoadoncafe_id')
            ->first();
            if(!is_null($tam1)) array_push($dskhachhangcafe, $tam1);
        }


        $dskhachhangkaraoke=array();
        foreach($khachhang as $key=>$value){
            $tam2=DB::table('tbl_khachhang') 
            ->where('tbl_khachhang.khachhang_id',$value->khachhang_id)
            ->join('tbl_congnokaraoke','tbl_congnokaraoke.khachhang_id','=','tbl_khachhang.khachhang_id')
            ->where('tbl_congnokaraoke.congnokaraoke_status',1)
            ->join('tbl_hoadonkaraoke','tbl_hoadonkaraoke.hoadonkaraoke_id','=','tbl_congnokaraoke.hoadonkaraoke_id')
            ->first();
            if(!is_null($tam2)) array_push($dskhachhangkaraoke, $tam2);
        }


        if(isset($dskhachhangcafe)&&is_null($dskhachhangkaraoke))  
            return view('pages.lietkecongno')->with('khachhang_cafe',$dskhachhangcafe);

        else if(isset($dskhachhangkaraoke)&&is_null($dskhachhangcafe)) 
            return view('pages.lietkecongno')->with('khachhang_karaoke',$dskhachhangkaraoke);
        else
            return view('pages.lietkecongno')->with('khachhang_cafe',$dskhachhangcafe)->with('khachhang_karaoke',$dskhachhangkaraoke);
        
        
    }

    public function chiTietCongNoCafe($hoadoncafe_id){

        $hoadoncafe=DB::table('tbl_hoadoncafeDetail')
        ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_hoadoncafeDetail.hoadoncafe_id')
        ->where('tbl_hoadoncafe.hoadoncafe_id',$hoadoncafe_id)
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadoncafeDetail.sanpham_id')
        ->get();
        return view('pages.lietKeCongNo')->with('hoadoncafe',$hoadoncafe)->with('hoadoncafe_id',$hoadoncafe_id);
    }

    public function chiTietCongNoKaraoke($hoadonkaraoke_id){
         $hoadonkaraoke=DB::table('tbl_hoadonkaraokeDetail')
        ->join('tbl_hoadonkaraoke','tbl_hoadonkaraoke.hoadonkaraoke_id','=','tbl_hoadonkaraokeDetail.hoadonkaraoke_id')
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadonkaraokeDetail.sanpham_id')
        ->get();

        $phongdetail=DB::table('tbl_hoadonkaraoke')
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_phong','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
        ->join('tbl_loaiphong','tbl_phong.loaiphong_id','=','tbl_loaiphong.loaiphong_id')
        ->first();
        return view('pages.lietKeCongNo')->with('hoadonkaraoke',$hoadonkaraoke)->with('phongdetail',$phongdetail)->with('hoadonkaraoke_id',$hoadonkaraoke_id);
    }

    public function thanhToanCongNoCafe($hoadoncafe_id){
        DB::table('tbl_hoadoncafe')
        ->where('tbl_hoadoncafe.hoadoncafe_id',$hoadoncafe_id)
        ->join('tbl_congnocafe','tbl_congnocafe.hoadoncafe_id','=','tbl_hoadoncafe.hoadoncafe_id')
        ->update(['tbl_congnocafe.congnocafe_status'=>0])  ;
        return Redirect::to('/thanh-toan-cafe/'.$hoadoncafe_id);
    }

    public function thanhToanCongNoKaraoke($hoadonkaraoke_id){
         DB::table('tbl_hoadonkaraoke')
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_congnokaraoke','tbl_congnokaraoke.hoadonkaraoke_id','=','tbl_hoadonkaraoke.hoadonkaraoke_id')
        ->update(['tbl_congnokaraoke.congnokaraoke_status'=>0]);

        $loaiphong_price=DB::table('tbl_hoadonkaraoke')
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_phong','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
        ->join('tbl_loaiphong','tbl_phong.loaiphong_id','=','tbl_loaiphong.loaiphong_id')
        ->pluck('tbl_loaiphong.loaiphong_price')->first();

        return Redirect::to('/thanh-toan-karaoke/'.$hoadonkaraoke_id.'/'.$loaiphong_price);
    }
}
