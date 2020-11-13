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
use PDF;
class OrderController extends Controller
{
    //
    public function print_bill_cafe($hoadoncafe_id){//mã hóa đơn
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($this->print_order_convert_cafe($hoadoncafe_id));
        $pdf->setPaper('A5');
    	return $pdf->stream();
    }
    public function print_order_convert_cafe($hoadoncafe_id){
    	$hoadon=DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->first();	
    	$hoadonDetail=DB::table('tbl_hoadoncafeDetail')
    	->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadoncafeDetail.sanpham_id')
    	->where('tbl_hoadoncafeDetail.hoadoncafe_id',$hoadoncafe_id)
    	->get();	

        $check=DB::table('tbl_congnocafe')
        ->where('hoadoncafe_id',$hoadoncafe_id)
        ->pluck('congnocafe_status')
        ->first();


    	$output='';
    	$output.='<style>body{
    		font-family: Dejavu Sans;
    	}
    	.table-styling{
    		border:1px solid black;
            width:500px;
            height:auto;
    	}
        .table-styling, th, td {
            border: 1px solid black;

        }
        
    	</style>
    	<h4><center>Công ty TNHH Tín Thành Việt Mỹ</center></h4>
    	<h4><center>____________________</center></h4>';
        if($check==1){
            $output.='<h4 style="font-family: Dejavu Sans;"><center>Hóa đơn công nợ cafe</center></h4>';
        }
        else{
            $output.='<h4><center>Hóa đơn thanh toán cafe</center></h4>';
        }

        $output.='
    	
    	<h4><center>Mã hóa đơn: '.$hoadon->hoadoncafe_id.'</center></h4>
    	<h4><center>Thời gian: '.$hoadon->hoadoncafe_time.'</center></h4>
    	<table class="table-styling">
    		<thead>
    			<tr >
    				<th>Sản phẩm</th>
    				<th>Số lượng</th>
    				<th>Đơn giá</th>	
    				<th>Thành tiền</th>
    			</tr>	
    		</thead>
    		<tbody>';
    		foreach($hoadonDetail as $key=>$value){
    		$output.='

    			<tr>	
    				<td>'.$value->sanpham_name.'</td>
    				<td><center>'.$value->hoadoncafeDetail_nums.'</center></td>
    				<td>'.$value->sanpham_price.' VNĐ</td>
    				<td>'.$value->hoadoncafeDetail_nums*$value->sanpham_price.' VNĐ</td>
    			</tr>';
    		}
    		$output.='
    		    <tr>	
    				<td><strong>Tổng cộng: </strong></td>
    				<td></td>
    				<td></td>
    				<td><strong>'.$hoadon->hoadoncafe_price.' VNĐ</strong></td>
    				
    			</tr>';
    		$output.='
    		</tbody>
    	</table>
        <br><br>
        <h4><center>Cảm ơn quý khách</center></h4>';

    	DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafe_status'=>0]);
    	DB::table('tbl_bancafe')
    	->join('tbl_hoadoncafe','tbl_bancafe.bancafe_id','=','tbl_hoadoncafe.bancafe_id')
    	->update(['bancafe_status'=>0]);

    	return $output;
    }



    public function print_bill_karaoke($hoadonkaraoke_id,$loaiphong_price){//mã hóa đơn
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert_karaoke($hoadonkaraoke_id,$loaiphong_price));
        $pdf->setPaper('A5');
        return $pdf->stream();
    }
    public function print_order_convert_karaoke($hoadonkaraoke_id,$loaiphong_price){
        
        $hoadon=DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->first();    
        $hoadonDetail=DB::table('tbl_hoadonkaraokeDetail')
        ->join('tbl_sanpham','tbl_sanpham.sanpham_id','=','tbl_hoadonkaraokeDetail.sanpham_id')
        ->where('tbl_hoadonkaraokeDetail.hoadonkaraoke_id',$hoadonkaraoke_id)
        ->get();    
        $tenphong=DB::table('tbl_hoadonkaraoke')
        ->where('hoadonkaraoke_id',$hoadonkaraoke_id)
        ->join('tbl_phong','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
        ->pluck('phong_name')->first();;
        //update giá trong hóa đơn



        $output='';
        $output.='<style>body{
            font-family: Dejavu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling, th, td {
            border: 1px solid black;
        }
        </style>
        <h4><center>Công ty TNHH Tín Thành Việt Mỹ</center></h4>
        <h4><center>____________________</center></h4>
        <h4><center>Hóa đơn thanh toán karaoke</center></h4>
        <h4><center>Mã hóa đơn: '.$hoadon->hoadonkaraoke_id.'</center></h4>
        <h4><center>Thời gian vào: '.$hoadon->hoadonkaraoke_timein.'</center></h4>
        <h4><center>Thời gian ra: '.$hoadon->hoadonkaraoke_timeout.'</center></h4>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>    
                    <th>Thành tiền</th>
                </tr>   
            </thead>
            <tbody>';
            foreach($hoadonDetail as $key=>$value){
            $output.='

                <tr>    
                    <td>'.$value->sanpham_name.'</td>
                    <td>'.$value->hoadonkaraokeDetail_nums.'</td>
                    <td>'.$value->sanpham_price.' VNĐ</td>
                    <td>'.$value->hoadonkaraokeDetail_nums*$value->sanpham_price.' VNĐ</td>
                </tr>';
            }
            $output.='
                <tr>
                    <td>Phòng '.$tenphong.'</td>
                    <td>'.$hoadon->hoadonkaraoke_time.' giờ</td>
                    <td>'.$loaiphong_price.' VNĐ</td>
                    <td>'.$loaiphong_price*$hoadon->hoadonkaraoke_time.' VNĐ</td>
                </tr>';
            $output.='
                <tr>    
                    <td><strong>Tổng cộng: </strong></td>
                    <td></td>
                    <td></td>
                    <td><strong>'.$hoadon->hoadonkaraoke_price.' VNĐ</strong></td>
                </tr>';
            $output.='
            </tbody>
        </table>
        <br><br>
        <h4><center>Cảm ơn quý khách</center></h4>';

        //Cập nhật trạng thái hóa đơn
        DB::table('tbl_hoadonkaraoke')->where('hoadonkaraoke_id',$hoadonkaraoke_id)->update(['hoadonkaraoke_status'=>0]);
        //Cập nhật trạng thái phòng
        DB::table('tbl_phong')
        ->join('tbl_hoadonkaraoke','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
        ->update(['phong_status'=>0]);

        return $output;
    }
}
