<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use PDF;
session_start();
class HoaDonKaraokeDetailController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function show_hoadonkaraokedetail($hoadonkaraoke_id)
    {
        $this->AuthLogin();
        $detail_hoadonkaraoke = DB::table('tbl_hoadonkaraokedetail')
            ->join('tbl_sanpham', 'tbl_hoadonkaraokedetail.sanpham_id', '=', 'tbl_sanpham.sanpham_id')
            ->join('tbl_hoadonkaraoke', 'tbl_hoadonkaraokedetail.hoadonkaraoke_id', '=', 'tbl_hoadonkaraoke.hoadonkaraoke_id')
            ->join('tbl_phong', 'tbl_hoadonkaraoke.phong_id', '=', 'tbl_phong.phong_id')
            ->orderby('tbl_hoadonkaraokedetail.hoadonkaraoke_id','desc')->get()->where('hoadonkaraoke_id',$hoadonkaraoke_id);
        $manager_hoadonkaraokedetail = view('admin.show_hoadonkaraokedetail')->with('show_hoadonkaraokedetail', $detail_hoadonkaraoke);
        return view('Admin_Layout')->with('admin.show_hoadonkaraokedetail', $manager_hoadonkaraokedetail);
    }
    function get_data($hoadonkaraoke_id)
    {
        $data= DB::table('tbl_hoadonkaraokedetail')
            ->join('tbl_sanpham', 'tbl_hoadonkaraokedetail.sanpham_id', '=', 'tbl_sanpham.sanpham_id')
            ->join('tbl_hoadonkaraoke', 'tbl_hoadonkaraokedetail.hoadonkaraoke_id', '=', 'tbl_hoadonkaraoke.hoadonkaraoke_id')
            ->join('tbl_phong', 'tbl_hoadonkaraoke.phong_id', '=', 'tbl_phong.phong_id')
            ->orderby('tbl_hoadonkaraokedetail.hoadonkaraoke_id', 'desc')->get()->where('hoadonkaraoke_id',$hoadonkaraoke_id);
        return $data;
    }
    public function print_hoadonkaraoke($hoadonkaraoke_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_hoadonkaraokedetail($hoadonkaraoke_id));
        $pdf->setPaper('A6');
        return $pdf->stream();
    }

    public function print_hoadonkaraokedetail($hoadonkaraoke_id)
    {
        $data = $this->get_data($hoadonkaraoke_id);
        $output = '';
        $output .= '<style> body{
                           font-family: DejaVu Sans ;
        }
        .table-styling{
        border: 1px solid black;
        }
        </style>
           <title>Xuất phiếu</title>
        <h1 style=" font-size: large"><center>Công ty TNHH Việt Mỹ Thành Tín</center></h1>
        <h4 style="font-size: 8px; margin-bottom: 0; padding: 0"><right>Địa chỉ: 9/2/18 Khúc Thừa Dụ 2, phường Vĩnh Niệm, quận Lê Chân, Thành phố Hải Phòng.</right></h4>
        <h4 style="font-size: 8px;"><left>Số điện thoại:0383161077</left></h4>
        <h1 style="font-size: medium"><center>PHIẾU THUÊ</center></h1>';
        foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                                   <li style=" font-family:DejaVu Sans; font-size:12px; list-style-type:none;"width="75px">Khách hàng: '.$detail->hoadonkaraoke_nguoi.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">Phòng: '.$detail->phong_name.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">MHĐ: '.$detail->hoadonkaraoke_id.'</li>
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
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Giờ vào: '.$detail->hoadonkaraoke_timein.'</th>
                                   <th style=" font-size:10px; list-style-type:none;"width="75px">Giờ ra: '.$detail->hoadonkaraoke_timeout.'</th>
                                   <a><b>Phí thuê phòng hát: '.number_format($detail->hoadonkaraoke_price,0,',','.').'đ'.'<b></a>>
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
                $subtotal = $detail->hoadonkaraokeDetail_nums*$detail->hoadonkaraokeDetail_price;
                $total += $subtotal;
                $output .= '
<table class="table styling">
                  <thead>
                 <tr>

                                   <!--<th style=" font-size:8px ;" width="80px">Phòng:' . $detail->phong_name . '</th><br>
                                   <th style=" font-size:8px ;" width="75px">Thời gian bắt đầu' . $detail->hoadonkaraoke_timein . '</th>
                                   <th style=" font-size:8px ;width="75px">Thời gian kết thúc:' . $detail->hoadonkaraoke_timeout . '</th>-->
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="90px";>' . $detail->sanpham_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px";>' . $detail->hoadonkaraokeDetail_nums . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($detail->hoadonkaraokeDetail_price, 0, ',', '.') . 'đ' . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</th>

                  </tr>
                  </thead>
                        </table>';
            }
        $output.= '
<table>
<tr>
				<td colspan="2">
					<p style="font-size: 12px"><b>Thanh toán : '.number_format($total + $detail->hoadonkaraoke_price,0,',','.').'đ'.'</b></p>
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

