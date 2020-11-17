<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\PhieuNhap;
session_start();

class PhieunhapDetailController extends Controller
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

    public function add_phieunhap(){
        $this->AuthLogin();
        $name_nguyenlieu = DB::table('tbl_nguyenlieu')->orderby('nguyenlieu_id','desc')->get();
        return view('admin.add_phieunhap')->with('name_nguyenlieu', $name_nguyenlieu);
    }
    public function save_phieunhap(Request $request){
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $name = Session::get('admin_name');
        $data['phieunhap_nguoi'] = $name;
        $data['phieunhap_time'] = $time;

        $price = 0;
        if(count($request->nguyenlieu_name) > 0)
        {
        foreach($request->nguyenlieu_name as $item=>$v){
            $price+= $request->phieunhapDetail_cost[$item]*$request->phieunhapDetail_nums[$item];
        }
    }
        
        $data['phieunhap_price'] =$price;
        $id = DB::table('tbl_phieunhap')->insertGetId($data);
        if(count($request->nguyenlieu_name) > 0)
        {
        foreach($request->nguyenlieu_name as $item=>$v){
            $data2=array(
                'phieunhap_id'=>$id,
                'nguyenlieu_id'=>$request->nguyenlieu_name[$item],
                'phieunhapDetail_cost' => $request->phieunhapDetail_cost[$item],
                'phieunhapDetail_nums' => $request->phieunhapDetail_nums[$item],
                'phieunhapDetail_dvt' => $request->dvt[$item],
                'phieunhapDetail_price' => $request->phieunhapDetail_cost[$item]*$request->phieunhapDetail_nums[$item]
            );
        PhieuNhap::insert($data2);
      }
        }
        return Redirect::to('thongke_phieunhap');
    }


    public function show_phieunhapdetail($phieunhap_id)
    {
        $this->AuthLogin();
        $detail_phieunhap = DB::table('tbl_phieunhapdetail')
            ->join('tbl_nguyenlieu', 'tbl_phieunhapdetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieunhap', 'tbl_phieunhapdetail.phieunhap_id', '=', 'tbl_phieunhap.phieunhap_id')
            ->orderby('tbl_phieunhapdetail.phieunhap_id','desc')->get()->where('phieunhap_id',$phieunhap_id);
        $manager_phieunhapdetail = view('admin.show_phieunhapdetail')->with('show_phieunhapdetail', $detail_phieunhap);
        return view('Admin_Layout')->with('admin.show_phieunhapdetail', $manager_phieunhapdetail);
    }
    function get_data($phieunhap_id)
    {
        $data= DB::table('tbl_phieunhapdetail')
            ->join('tbl_nguyenlieu', 'tbl_phieunhapdetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieunhap', 'tbl_phieunhapdetail.phieunhap_id', '=', 'tbl_phieunhap.phieunhap_id')
            ->orderby('tbl_phieunhapdetail.phieunhap_id', 'desc')->get()->where('phieunhap_id',$phieunhap_id);
        return $data;
    }
    public function print_phieunhap($phieunhap_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_phieunhapdetail($phieunhap_id));
        $pdf->setPaper('A6');
        return $pdf->stream();
    }
    public function print_phieunhapdetail($phieunhap_id)
    {
        $data = $this->get_data($phieunhap_id);
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
        <h1 style="font-size: medium"><center>PHIẾU NHẬP</center></h1>';
        foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                                   <li style=" font-family:DejaVu Sans; font-size:12px; list-style-type:none;"width="75px">Người nhập: '.$detail->phieunhap_nguoi.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">MHĐ: '.$detail->phieunhap_id.'</li>
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
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Ngày nhập: '.$detail->phieunhap_time.'</th>
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
            $subtotal = $detail->phieunhapDetail_nums*$detail->phieunhapDetail_cost;
            $total += $subtotal;
            $output .= '
<table class="table styling">
                  <thead>
                 <tr>

                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="90px";>' . $detail->nguyenlieu_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px";>' . $detail->phieunhapDetail_nums . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($detail->phieunhapDetail_cost, 0, ',', '.') . 'đ' . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($subtotal, 0, ',', '.') . 'đ' . '</th>

                  </tr>
                  </thead>
                        </table>';
        }
        $output.= '
<table>
<tr>
				<td colspan="2">
					<p><b style="font-size: 12px">Tổng : '.number_format($total,0,',','.').'đ'.'</b></p>
				</td>
		</tr>
		</table>';

        $output .= '
                <p style="text-align: right; font-size:10px;">Hải Phòng, ngày...tháng...năm...</p>
                <table>
                <thead>
                <tr>
                <th style="font-size: 10px;" width="100px">Người lập phiếu</th>
                <th style="font-size: 10px;" width="250px">Người nhận</th>
        </tr>
        </thead>';
        $output .= '</table>';
        return $output;
    }
}
