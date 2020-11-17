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
    public function AuthLogin_frontend() //done
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('login')->send();
        }
    }

    public function showBill($bancafe_id,$loaisanpham_id){
        $this->AuthLogin_frontend();
        $all_loaisanpham=DB::table('tbl_loaisanpham')->get();
        $all_sanpham=DB::table('tbl_sanpham')
        ->where('loaisanpham_id',$loaisanpham_id)
        ->get();

        $all_hoadon=DB::table('tbl_hoadoncafeDetail')
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadoncafeDetail.sanpham_id')
        ->join('tbl_hoadoncafe','tbl_hoadoncafe.hoadoncafe_id','=','tbl_hoadoncafeDetail.hoadoncafe_id')
        ->where('bancafe_id',$bancafe_id)
        ->where('tbl_hoadoncafe.hoadoncafe_status',1)
        ->get();


        $hoadon_id=DB::table('tbl_hoadoncafe')
        ->where('hoadoncafe_status',1)
        ->where('bancafe_id',$bancafe_id)
        ->pluck('hoadoncafe_id')->first();
        

        $price_hoadon=0;
        foreach($all_hoadon as $key=>$value){ //Tính tổng tiền hóa đơn
            $price_hoadon=$price_hoadon+$value->hoadoncafeDetail_price;
        }
          	
        return view('pages.menu')->with('all_loaisanpham',$all_loaisanpham)->with('all_sanpham',$all_sanpham)
        ->with('all_hoadon',$all_hoadon)->with('ban_id',$bancafe_id)->with('price_hoadon',$price_hoadon)->with('hoadoncafe_id',$hoadon_id);
    }

    public function plusProduct($sanpham_id,$hoadoncafe_id){
        
    	$hdDetail=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->first();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $i=$hdDetail->hoadoncafeDetail_nums+1;

    	DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->update(['hoadoncafeDetail_nums'=>$i]);

        //update giá hoadoncafeDetail trong csdl
        $price_totalDetail=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafeDetail_price')->first(); //Tổng giá trong chi tiết hóa đơn
        $price_product=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->pluck('sanpham_price')->first(); //giá sản phẩm
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafeDetail_price'=>$price_totalDetail+$price_product]);
        //update gía hoadoncafe trong csdl
        $price_total=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafe_price')->first(); //Tổng giá trong hóa đơn
        DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafe_price'=>$price_total+$price_product]);


    	$bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first(); 
    	return Redirect::to('/cafe-select-product/'.$bancafe_id.'/'.$sanpham->loaisanpham_id);
    }

    public function minusProduct($sanpham_id,$hoadoncafe_id){

    	$hdDetail=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->first();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $i=$hdDetail->hoadoncafeDetail_nums-1;
        if($i==0){
            return Redirect::to('/delete/'.$sanpham_id.'/'.$hoadoncafe_id);
        }
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->update(['hoadoncafeDetail_nums'=>$i]);
        //update giá hoadoncafeDetail trong csdl
        $price_total=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafeDetail_price')->first();
        $price_product=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->pluck('sanpham_price')->first();
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafeDetail_price'=>$price_total-$price_product]);
        //update gía hoadoncafe trong csdl
        $price_total=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafe_price')->first(); //Tổng giá trong hóa đơn
        DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafe_price'=>$price_total-$price_product]);


        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        return Redirect::to('/cafe-select-product/'.$bancafe_id.'/'.$sanpham->loaisanpham_id);
    }

    public function deleteProduct($sanpham_id,$hoadoncafe_id){
        $price_hdDetail_xoa=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafeDetail_price')->first();
        DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)
        ->delete();
        $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
        $bancafe_id=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('bancafe_id')->first();
        $check=DB::table('tbl_hoadoncafeDetail')->where('hoadoncafe_id',$hoadoncafe_id)->first();
        if(is_null(($check))){
            DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update(['bancafe_status'=>0]);
            DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->delete();// Xóa hóa đơn
        }
        else{
            //update gía hoadoncafe trong csdl
            $hd_detail=DB::table('tbl_hoadoncafeDetail')->where('sanpham_id',$sanpham_id)->where('hoadoncafe_id',$hoadoncafe_id)->get();
            $price_total=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->pluck('hoadoncafe_price')->first(); 
            DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafe_price'=>$price_total-$price_hdDetail_xoa]);

        }
        return Redirect::to('/cafe-select-product/'.$bancafe_id.'/'.$sanpham->loaisanpham_id);
    }

    public function chooseProduct($sanpham_id,$ban_id){
        $this->AuthLogin_frontend();
        $bill=DB::table('tbl_hoadoncafe')->where('bancafe_id',$ban_id)->where('hoadoncafe_status','1')->orderby('hoadoncafe_id','desc')->first();
        if(is_null($bill)){ //Bàn trống, chưa có hoá đơn

                $sanpham=DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->first(); //Lấy sản phẩm
                $time=Carbon::now('Asia/Ho_Chi_Minh');
                $name = Session::get('admin_name');
                //Tạo hóa đơn   
                $hoadon=array();
                $hoadon['bancafe_id']=$ban_id;
                $hoadon['hoadoncafe_time']=$time;
                $hoadon['hoadoncafe_nguoi']=$name;
                $hoadon['hoadoncafe_price']=0;
                $hoadon['hoadoncafe_status']=1;
           
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
                return Redirect::to('/cafe-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
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
                    return Redirect::to('/cafe-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
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

                    return Redirect::to('/cafe-select-product/'.$ban_id.'/'.$sanpham->loaisanpham_id);
                }
                
                
        }
    }
}
