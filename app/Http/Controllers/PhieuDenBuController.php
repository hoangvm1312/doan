<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; //Sử dụng database

//Thư viện thêm cho phần logout
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();
use App\PhieuDenBu;

class PhieuDenBuController extends Controller
{
    public function nhapThietBi(){
    	return view('pages.phieudenbu');
    }
    public function savePhieu(Request $request){
    	$time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $data['phieudenbu_time'] = $time;
        $data['phieudenbu_nguoi'] = 'nhanvien';	
        $price = 0;
        if(count($request->thietbi_name) > 0)
        {
        	foreach($request->thietbi_name as $item=>$v){
        		
            	$price+= $request->phieudenbuDetail_cost[$item]*$request->phieudenbuDetail_nums[$item];
        	}
        }
        
        $data['phieudenbu_price'] =$price;
        $id = DB::table('tbl_phieudenbu')->insertGetId($data);

        if(count($request->thietbi_name) > 0)
        {
        	foreach($request->thietbi_name as $item=>$v){
        		
            $data2=array(
                'phieudenbu_id'=>$id,
                'thietbi_name'=>$request->thietbi_name[$item],
                'phieudenbuDetail_cost' => $request->phieudenbuDetail_cost[$item],
                'phieudenbuDetail_nums' => $request->phieudenbuDetail_nums[$item],
                'phieudenbuDetail_reason' => $request->phieudenbuDetail_reason[$item],
                'phieudenbuDetail_price' => $request->phieudenbuDetail_cost[$item]*$request->phieudenbuDetail_nums[$item],
                'phieudenbuDetail_note' => $request->phieudenbuDetail_note[$item]
            );
        	phieudenbu::insert($data2);
      		}
      		
        	return Redirect::to('/in-phieu-den-bu/'.$id);
    	}
    	
    	else return Redirect::to('/nhap-thiet-bi'); 
    }
    public function print_phieudenbu($id){
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML($this->print_order_convert($id));
        $pdf->setPaper('A5');
    	return $pdf->stream();
    }
    public function print_order_convert($id){
    	$phieudenbu=DB::table('tbl_phieudenbu')
    	->where('phieudenbu_id',$id)
    	->first();

    	$phieudenbuDetail=DB::table('tbl_phieudenbuDetail')
    	->where('tbl_phieudenbuDetail.phieudenbu_id',$id)
    	->get();

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
        
        $output.='<h4><center>Hóa đơn thanh toán phiếu đền bù</center></h4>';
        

        $output.='
    	
    	<h4><center>Mã phiếu: '.$phieudenbu->phieudenbu_id.'</center></h4>
    	<h4><center>Thời gian: '.$phieudenbu->phieudenbu_time.'</center></h4>
    	<table class="table-styling">
    		<thead>
    			<tr >
    				<th>Tên thiết bị</th>
    				<th>Đơn giá</th>
    				<th>Số lượng</th>	
    				<th>Lý do</th>
    				<th>Tổng tiền</th>
    			</tr>	
    		</thead>
    		<tbody>';
    		foreach($phieudenbuDetail as $key=>$value){
    		$output.='

    			<tr>	
    				<td>'.$value->thietbi_name.'</td>
    				<td>'.$value->phieudenbuDetail_cost.' VNĐ</td>
    				<td>'.$value->phieudenbuDetail_nums.'</td>
    				<td>'.$value->phieudenbuDetail_reason.'</td>
    				<td>'.$value->phieudenbuDetail_price.'</td>
    			</tr>';
    		}
    		$output.='
    		    <tr>	
    				<td><strong>Tổng cộng: </strong></td>
    				<td></td>
    				<td></td>
    				<td></td>
    				<td><strong>'.$phieudenbu->phieudenbu_price.' VNĐ</strong></td>
    				
    			</tr>';
    		$output.='
    		</tbody>
    	</table>
        <br><br>
        <h4><center>Cảm ơn quý khách</center></h4>';


        return $output;
    }
    
}
