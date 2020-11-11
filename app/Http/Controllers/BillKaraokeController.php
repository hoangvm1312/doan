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

class BillKaraokeController extends Controller
{
    public function showBill($phong_id,$loaisanpham_id){
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')
        ->where('loaisanpham_id',$loaisanpham_id)
        ->get();

        $all_hoadon=DB::table('tbl_hoadonkaraokeDetail')
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadonkaraokeDetail.sanpham_id')
        ->join('tbl_hoadonkaraoke','tbl_hoadonkaraoke.hoadonkaraoke_id','=','tbl_hoadonkaraokeDetail.hoadonkaraoke_id')
        ->where('phong_id',$phong_id)
        ->where('tbl_hoadonkaraoke.hoadonkaraoke_status',1)
        ->get();

        $hoadon=DB::table('tbl_hoadonkaraoke')
        ->where('hoadonkaraoke_status',1)
        ->where('phong_id',$phong_id)
        ->first();


        $phong_price=DB::table('tbl_phong')
        ->join('tbl_loaiphong','tbl_loaiphong.loaiphong_id','=','tbl_phong.loaiphong_id')
        ->where('phong_id',$phong_id)
        ->pluck('loaiphong_price')
        ->first();

        $price_hoadon=0;
        foreach($all_hoadon as $key=>$value){ //Tính tổng tiền hóa đơn
            $price_hoadon=$price_hoadon+$value->hoadonkaraokeDetail_price;
        }
    	
        return view('pages.menuKaraoke')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham) ->with('all_hoadon',$all_hoadon)->with('phong_id',$phong_id)->with('hoadon',$hoadon)->with('price_hoadon',$price_hoadon)->with('phong_price',$phong_price)->with('hoadonkaraoke_id',$hoadon->hoadonkaraoke_id);
    }

    public function plusProduct($sanpham_id,$hoadonkaraoke_id){
    	$hdDetail=DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->first();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $i=$hdDetail->hoadonkaraokeDetail_nums+1;

    	DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)
        ->update(['hoadonkaraokeDetail_nums'=>$i]);

        //update giá hoadonkaraokeDetail trong csdl
        $price_totalDetail=DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('hoadonkaraokeDetail_price')->first(); //Tổng giá trong chi tiết hóa đơn
        $price_product=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->pluck('sanpham_price')->first(); //giá sản phẩm
        DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraokeDetail_price'=>$price_totalDetail+$price_product]);
        //update gía hoadonkaraoke trong csdl
        $price_total=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('hoadonkaraoke_price')->first(); //Tổng giá trong hóa đơn
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$price_total+$price_product]);


    	$phong_id=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('phong_id')->first(); 
    	return Redirect::to('/karaoke-select-product/'.$phong_id.'/'.$sanpham->loaisanpham_id);
    }

    public function minusProduct($sanpham_id,$hoadonkaraoke_id){
    	$hdDetail=DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->first();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $i=$hdDetail->hoadonkaraokeDetail_nums-1;
        if($i==0){
            return Redirect::to('/delete-karaoke/'.$sanpham_id.'/'.$hoadonkaraoke_id);
        }
        DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)
        ->update(['hoadonkaraokeDetail_nums'=>$i]);
        //update giá hoadonkaraokeDetail trong csdl
        $price_total=DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('hoadonkaraokeDetail_price')->first();
        $price_product=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->pluck('sanpham_price')->first();
        DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraokeDetail_price'=>$price_total-$price_product]);
        //update gía hoadonkaraoke trong csdl
        $price_total=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('hoadonkaraoke_price')->first(); //Tổng giá trong hóa đơn
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$price_total-$price_product]);


        $phong_id=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('phong_id')->first();
        return Redirect::to('/karaoke-select-product/'.$phong_id.'/'.$sanpham->loaisanpham_id);
    }

    public function deleteProduct($sanpham_id,$hoadonkaraoke_id){
        DB::table('tbl_hoadonkaraokeDetail')->where('sanpham_id',$sanpham_id)->where('hoadonkaraoke_id',$hoadonkaraoke_id)
        ->delete();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $phong_id=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->pluck('phong_id')->first();
        $check=DB::table('tbl_hoadonkaraokeDetail')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->first();
        if(is_null(($check))){
            DB::table('tbl_phong')->where('phong_id',$phong_id)->update(['phong_status'=>0]);
            DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->delete();// Xóa hóa đơn
        }
        return Redirect::to('/karaoke-select-product/'.$phong_id.'/'.$sanpham->loaisanpham_id);
    }

    public function chooseProduct($sanpham_id,$ban_id){
        $bill=DB::table('tbl_hoadonkaraoke')->where('phong_id',$ban_id)->where('hoadonkaraoke_status','1')->orderby('hoadonkaraoke_id','desc')->first();
        if(is_null($bill)){ //Bàn trống, chưa có hoá đơn

                $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
                $time=Carbon::now('Asia/Ho_Chi_Minh');

                //Tạo hóa đơn   
                $hoadon=array();
                $hoadon['phong_id']=$ban_id;
                $hoadon['hoadonkaraoke_timein']=$time;
                $hoadon['hoadonkaraoke_timeout']=$time;
                $hoadon['hoadonkaraoke_nguoi']='nhan vien';
                $hoadon['hoadonkaraoke_price']=0;
                $hoadon['hoadonkaraoke_status']=1;
                DB::table('tbl_hoadonkaraoke')->insert($hoadon);

                $hoadon_complete=DB::table('tbl_hoadonkaraoke')->orderby('hoadonkaraoke_id','desc')->first(); // Lấy hóa đơn vừa tạo

                //Tạo hóa chi tiết hóa đơn
                $hoadonDetail=array();
                $hoadonDetail['hoadonkaraoke_id']=$hoadon_complete->hoadonkaraoke_id;
                $hoadonDetail['sanpham_id']=$sanpham->sanpham_id;
                $hoadonDetail['hoadonkaraokeDetail_nums']=1;
                $hoadonDetail['hoadonkaraokeDetail_price']=$sanpham->sanpham_price*1;
                DB::table('tbl_hoadonkaraokeDetail')->insert($hoadonDetail);

                DB::table('tbl_phong')->where('phong_id',$ban_id)->update(['phong_status'=>1]);
                //Cập nhật giá trong hóa đơn
                DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadon_complete->hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$sanpham->sanpham_price]);
                return Redirect::to('/karaoke-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
        }
        else{

                //Trường hợp thêm món ăn mới
                $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
                $hddetail=DB::table('tbl_hoadonkaraokeDetail')->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)->where('sanpham_id',$sanpham_id)->first(); //Lấy chi tiết hóa đơn
                if(is_null($hddetail)){ //Trường hợp thêm món chưa có trong hóa đơn
                    $hoadonDetail=array();
                    $hoadonDetail['hoadonkaraoke_id']=$bill->hoadonkaraoke_id;
                    $hoadonDetail['sanpham_id']=$sanpham_id;
                    $hoadonDetail['hoadonkaraokeDetail_nums']=1;
                    $hoadonDetail['hoadonkaraokeDetail_price']=$sanpham->sanpham_price*1;
                    DB::table('tbl_hoadonkaraokeDetail')->insert($hoadonDetail);

                    //cập nhật giá trong hóa đơn
                    $price=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)->pluck('hoadonkaraoke_price')->first();
                    DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$price+$sanpham->sanpham_price]);
                    return Redirect::to('/karaoke-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
                }
                else{ //Trường hợp thêm món đã có trong hóa đơn
                    $nums=DB::table('tbl_hoadonkaraokeDetail')
                    ->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->pluck('hoadonkaraokeDetail_nums')->first();   
                    $nums=$nums+1;

                    $price=DB::table('tbl_sanpham')
                    ->where('sanpham_id',$sanpham_id)
                    ->pluck('sanpham_price')->first();  

                    DB::table('tbl_hoadonkaraokeDetail') //update số lượng
                    ->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->update(['hoadonkaraokeDetail_nums'=>$nums]);

                    DB::table('tbl_hoadonkaraokeDetail') //update giá
                    ->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)
                    ->where('sanpham_id',$sanpham_id)
                    ->update(['hoadonkaraokeDetail_price'=>$nums*$price]);
                    
                    //cập nhật giá trong hóa đơn
                    $price_hd=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)->pluck('hoadonkaraoke_price')->first();
                    DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$bill->hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$price_hd+$sanpham->sanpham_price]);

                    return Redirect::to('/karaoke-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
                }
                
                
        }
    }

    public function checkout($hoadonkaraoke_id,$phong_id){
        $timenow=Carbon::now('Asia/Ho_Chi_Minh');
        $hoadonkaraoke=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->first();
        //Cập nhật giờ ra
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_timeout'=>$timenow]);
        //Tính thời gian khách sử dụng phòng
        $timeUse=$timenow->diffInMinutes($hoadonkaraoke->hoadonkaraoke_timein)/60;
        number_format((float)$timeUse, 1, '.', '');
        echo($timeUse);
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_time'=>$timeUse]);
        //lấy giá loại phòng
        $loaiphong_price= DB::table('tbl_phong')
        ->where('tbl_phong.phong_id',$phong_id)
        ->join('tbl_loaiphong','tbl_phong.loaiphong_id','=','tbl_loaiphong.loaiphong_id')
        ->pluck('tbl_loaiphong.loaiphong_price')->first();
        //Tính tổng tiền
        $money=$hoadonkaraoke->hoadonkaraoke_price+$loaiphong_price*$timeUse;

        //Cập nhật tổng tiền vào csdl
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_price'=>$money]);
        //Chuyển sang in hóa đơn
        return Redirect::to('/thanh-toan-karaoke/'.$hoadonkaraoke_id.'/'.$loaiphong_price);
    }
}
