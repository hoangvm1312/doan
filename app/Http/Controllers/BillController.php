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

class BillController extends Controller
{
    public function showBill($bancafe_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')
        ->where('loaisanpham_id','1')
        ->get();

        $all_hoadon=DB::table('tbl_hoadoncafeDetail')
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadoncafeDetail.sanpham_id')
        ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_hoadoncafeDetail.hoadoncafe_id')
        ->where('bancafe_id',$bancafe_id)
        ->get();
    	
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham)
        ->with('all_hoadon',$all_hoadon)->with('ban_id',$bancafe_id);
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

    public function minusProduct($sanpham_id,$hoadoncafe_id){
    	$product=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->first();
        $i=$product->hoadoncafeDetail_nums-1;
        if($i==0){
            DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
            ->delete();
            $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
            return Redirect::to('/cafe-select-product/'.$bancafe_id);
        }
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->update(['hoadoncafeDetail_nums'=>$i]);
        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function deleteProduct($sanpham_id,$hoadoncafe_id){
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->delete();
        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function chooseProduct($sanpham_id,$ban_id){
        $bill=DB::table('tbl_hoadoncafe')->where('bancafe_id',$ban_id)->where('hoadoncafe_status','1')->first();
        if(is_null($bill)){ //Bàn trống, chưa có hoá đơn

                $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
                $time=Carbon::now('Asia/Ho_Chi_Minh');

                //Tạo hóa đơn   
                $hoadon=array();
                $hoadon['bancafe_id']=$ban_id;
                $hoadon['hoadoncafe_time']=$time;
                $hoadon['hoadoncafe_nguoi']='nhan vien';
                $hoadon['hoadoncafe_price']=0;
                $hoadon['hoadoncafe_status']=1;
                $hoadon['khachhang_id']=1;
                DB::table('tbl_hoadoncafe')->insert($hoadon);
                $bill=DB::table('tbl_hoadoncafe')->orderby('hoadoncafe_id','desc')->first(); // Lấy hóa đơn vừa tạo

                //Tạo hóa chi tiết hóa đơn
                $hoadonDetail=array();
                $hoadonDetail['hoadoncafe_id']=$bill->hoadoncafe_id;
                $hoadonDetail['sanpham_id']=$sanpham->sanpham_id;
                $hoadonDetail['hoadoncafeDetail_nums']=1;
                $hoadonDetail['hoadoncafeDetail_price']=$sanpham->sanpham_price*1;
                DB::table('tbl_hoadoncafeDetail')->insert($hoadonDetail);

                return Redirect::to('/cafe-select-product/'.$ban_id);
        }
        else{
                
        }
    }
}
