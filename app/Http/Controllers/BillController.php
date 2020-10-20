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
        
    	return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function minusProduct($sanpham_id,$hoadoncafe_id){
    	$product=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->first();
        $i=$product->hoadoncafeDetail_nums-1;
        if($i==0){
            DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
            ->delete();
            $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
            DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update(['bancafe_status'=>0]);//Tắt hiện thị bàn
            DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->delete();// Xóa hóa đơn
            return Redirect::to('/cafe-select-product/'.$bancafe_id);
        }
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->update(['hoadoncafeDetail_nums'=>$i]);
        //update giá hoadoncafeDetail trong csdl




        
        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function deleteProduct($sanpham_id,$hoadoncafe_id){
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->delete();
        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        $check=DB::table('tbl_hoadoncafeDetail')->where('hoadoncafe_id',$hoadoncafe_id)->first();
        if(is_null(($check))){
            DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update(['bancafe_status'=>0]);
            DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->delete();// Xóa hóa đơn
        }
        return Redirect::to('/cafe-select-product/'.$bancafe_id);
    }

    public function chooseProduct($sanpham_id,$ban_id){
        $bill=DB::table('tbl_hoadoncafe')->where('bancafe_id',$ban_id)->where('hoadoncafe_status','1')->orderby('hoadoncafe_id','desc')->first();
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

                $hoadon_complete=DB::table('tbl_hoadoncafe')->orderby('hoadoncafe_id','desc')->first(); // Lấy hóa đơn vừa tạo

                //Tạo hóa chi tiết hóa đơn
                $hoadonDetail=array();
                $hoadonDetail['hoadoncafe_id']=$hoadon_complete->hoadoncafe_id;
                $hoadonDetail['sanpham_id']=$sanpham->sanpham_id;
                $hoadonDetail['hoadoncafeDetail_nums']=1;
                $hoadonDetail['hoadoncafeDetail_price']=$sanpham->sanpham_price*1;
                DB::table('tbl_hoadoncafeDetail')->insert($hoadonDetail);

                DB::table('tbl_bancafe')->where('bancafe_id',$ban_id)->update(['bancafe_status'=>1]);
                //Cập nhật giá trong hóa đơn
                DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadon_complete->hoadoncafe_id)->update(['hoadoncafe_price'=>$sanpham->sanpham_price]);
                return Redirect::to('/cafe-select-product/'.$ban_id);
        }
        else{

                //Trường hợp thêm món ăn mới
                $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
                $hddetail=DB::table('tbl_hoadoncafeDetail')->where('hoadoncafe_id',$bill->hoadoncafe_id)->where('sanpham_id',$sanpham_id)->first(); //Lấy chi tiết hóa đơn
                if(is_null($hddetail)){ //Trường hợp thêm món chưa có trong hóa đơn
                    $hoadonDetail=array();
                    $hoadonDetail['hoadoncafe_id']=$bill->hoadoncafe_id;
                    $hoadonDetail['sanpham_id']=$sanpham_id;
                    $hoadonDetail['hoadoncafeDetail_nums']=1;
                    $hoadonDetail['hoadoncafeDetail_price']=$sanpham->sanpham_price*1;
                    DB::table('tbl_hoadoncafeDetail')->insert($hoadonDetail);

                    //cập nhật giá trong hóa đơn
                    $price=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$bill->hoadoncafe_id)->pluck('hoadoncafe_price')->first();
                    DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$bill->hoadoncafe_id)->update(['hoadoncafe_price'=>$price+$sanpham->sanpham_price]);
                    return Redirect::to('/cafe-select-product/'.$ban_id);
                }
                else{ //Trường hợp thêm món đã có trong hóa đơn
                    $nums=DB::table('tbl_hoadoncafeDetail')
                    ->where('hoadoncafe_id',$bill->hoadoncafe_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->pluck('hoadoncafeDetail_nums')->first();   
                    $nums=$nums+1;

                    $price=DB::table('tbl_sanpham')
                    ->where('sanpham_id',$sanpham_id)
                    ->pluck('sanpham_price')->first();  

                    DB::table('tbl_hoadoncafeDetail') //update số lượng
                    ->where('hoadoncafe_id',$bill->hoadoncafe_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->update(['hoadoncafeDetail_nums'=>$nums]);

                    DB::table('tbl_hoadoncafeDetail') //update giá
                    ->where('hoadoncafe_id',$bill->hoadoncafe_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->update(['hoadoncafeDetail_price'=>$nums*$price]);
                    
                    //cập nhật giá trong hóa đơn
                    $price_hd=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$bill->hoadoncafe_id)->pluck('hoadoncafe_price')->first();
                    DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$bill->hoadoncafe_id)->update(['hoadoncafe_price'=>$price_hd+$sanpham->sanpham_price]);


                    return Redirect::to('/cafe-select-product/'.$ban_id);
                }
                
                
        }
    }
}
