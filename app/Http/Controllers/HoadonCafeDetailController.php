<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HoadonCafeDetailController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function show_hoadoncafedetail($hoadoncafe_id)
    {
        $this->AuthLogin();

        $detail_hoadoncafe = DB::table('tbl_hoadoncafedetail')
            ->join('tbl_sanpham','tbl_hoadoncafedetail.sanpham_id','=','tbl_sanpham.sanpham_id')
            ->join('tbl_bancafe', 'tbl_hoadoncafedetail.bancafe_id', '=', 'tbl_bancafe.bancafe_id')
            ->join('tbl_hoadoncafe','tbl_hoadoncafedetail.hoadoncafe_id','=','tbl_hoadoncafe.hoadoncafe_id')
            ->orderby('tbl_hoadoncafedetail.hoadoncafe_id', 'desc')->get()->where('hoadoncafe_id',$hoadoncafe_id);
        $manager_hoadoncafedetail = view('admin.show_hoadoncafedetail')->with('show_hoadoncafedetail',$detail_hoadoncafe);
        return view('Admin_Layout')->with('admin.show_hoandoncafedetail', $manager_hoadoncafedetail);
    }
    function get_data($hoadoncafe_id)
    {
/*        $data= DB::table('tbl_phieuthuedetail')
            ->join('tbl_sanpham', 'tbl_phieuthuedetail.sanpham_id', '=', 'tbl_sanpham.sanpham_id')
            ->join('tbl_phong', 'tbl_phieuthuedetail.phong_id', '=', 'tbl_phong.phong_id')
            ->join('tbl_phieuthue', 'tbl_phieuthuedetail.phieuthue_id', '=', 'tbl_phieuthue.phieuthue_id')
            ->orderby('tbl_phieuthuedetail.phieuthue_id', 'desc')->get();
        return $data;*/
        $data = DB::table('tbl_hoadoncafedetail')
            ->join('tbl_sanpham','tbl_hoadoncafedetail.sanpham_id','=','tbl_sanpham.sanpham_id')
            ->join('tbl_bancafe', 'tbl_hoadoncafedetail.bancafe_id', '=', 'tbl_bancafe.bancafe_id')
            ->join('tbl_hoadoncafe','tbl_hoadoncafedetail.hoadoncafe_id','=','tbl_hoadoncafe.hoadoncafe_id')
            ->orderby('tbl_hoadoncafedetail.hoadoncafe_id', 'desc')->get()->where('hoadoncafe_id',$hoadoncafe_id);
        return $data;
    }
    public function print_hoadoncafe($hoadoncafe_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_hoadondetail($hoadoncafe_id));
        $pdf->setPaper('A6');
        return $pdf->stream();
    }
    public function print_hoadondetail($hoadoncafe_id)
    {
        $data = $this->get_data($hoadoncafe_id);
        $output = '';
        $output .= '<style> body{
                           font-family: DejaVu Sans ;
        }
        .table-styling{
        border: 1px solid black;
        }
        </style>
        <title>Xuất hóa đơn</title>
        <h1 style=" font-size: large"><center>Công ty TNHH Việt Mỹ Thành Tín</center></h1>
        <h4 style="font-size: 8px; margin-bottom: 0; padding: 0"><right>Địa chỉ liên hệ:</right></h4>
        <h4 style="font-size: 8px;"><left>Số điện thoại:</left></h4>
        <h1 style="font-size: medium"><center>HÓA ĐƠN CÀ PHÊ</center></h1>';
        foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">'.$detail->bancafe_name.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">MHĐ: '.$detail->hoadoncafe_id.'</li>
        </tr>
        </thead>
        </table>';
 foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                               </li>
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Thời gian: '.$detail->hoadoncafe_time.'</th>
        </tr>
        </thead>
        </table>';
        $output.='
        <table class="table styling">
                  <thead>
                 <tr>
                            </th>
<!--                                <th style=" font-size:8px;border: 1px solid; padding:0 1px; " width="40px">Phòng</th>
                                <th style=" font-size:8px ;border: 1px solid; padding:1px;" width="75px">Thời gian bắt đầu</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="75px">Thời gian kết thúc</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="45px">Stt</th>-->
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px">Sản phẩm</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px">Số lượng</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px">Giá</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px">Thành tiền</th>
                  </tr>
                  </thead>
                        </table>';
        $total = 0;
        foreach($data as $key => $detail) {

        }
        foreach($data as $key => $detail) {
            $subtotal = $detail->hoadoncafeDetail_nums*$detail->hoadoncafeDetail_price;
            $total += $subtotal;
            $output .= '
<table class="table styling">
                  <thead>
                 <tr>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="90px";>' . $detail->sanpham_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px";>' . $detail->hoadoncafeDetail_nums . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($detail->hoadoncafeDetail_price, 0, ',', '.') . 'đ' . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</th>

                  </tr>
                  </thead>
                        </table>';
        }
        $output.= '
<table>
<tr>
				<td colspan="2">
					<p>Thanh toán : '.number_format($total,0,',','.').'đ'.'</p>
				</td>
		</tr>
		</table>';

        $output .= '
                <p style="text-align: right; font-size:10px;">Hải Phòng, ngày...tháng...năm...</p>
                <table>
                <thead>
                <tr>
                <th style="font-size: 10px;" width="100px">Người lập phiếu</th>
                <th style="font-size: 10px;" width="250px">Khách hàng</th>
        </tr>
        </thead>';
        $output .= '</table>';
        return $output;
    }
}
