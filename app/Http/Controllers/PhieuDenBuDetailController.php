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
// use App\PhieuDenBu;

class PhieuDenBuDetailController extends Controller
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
    public function add_phieudenbu(){
        $this->AuthLogin();
        $name_thietbi = DB::table('tbl_thietbi')->orderby('thietbi_id','desc')->get();
        return view('admin.add_phieudenbu')->with('name_thietbi', $name_thietbi);
    }
    public function save_phieudenbu(Request $request){
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $name = Session::get('admin_name');
        $data['phieudenbu_nguoi'] = $name;
        $data['phieudenbu_time'] = $time;

        // $datadetail = array();
        // $datadetail['thietbi_id'] = $request->thietbi_name;
        // $datadetail['phieudenbu_id'] = $id;
        // $datadetail['phieudenbuDetail_cost'] = $request->phieudenbuDetail_cost;
        // $datadetail['phieudenbuDetail_nums'] = $request->phieudenbuDetail_nums;
        // $datadetail['phieudenbuDetail_dvt'] = $request->dvt;
        $price = 0;
        if(count($request->thietbi_name) > 0)
        {
        foreach($request->thietbi_name as $item=>$v){
            $price+= $request->phieudenbuDetail_cost[$item]*$request->phieudenbuDetail_nums[$item];
                                                        }
        }
        // $price+= $request->phieudenbuDetail_cost*$request->phieudenbuDetail_nums;
        // // $total = DB::table('phieudenbudetail')->sum('phieudenbuDetail_price');
        // $datadetail['phieudenbuDetail_reason'] = $request->phieudenbuDetail_reason;
        // $datadetail['phieudenbuDetail_price'] = $price;
        $data['phieudenbu_price'] =$price;
        $id = DB::table('tbl_phieudenbu')->insertGetId($data);
        // $lastInsertedID = $data->insert_id;
        // echo $lastInsertedID;
        // echo $id;
        // $datadetail['phieudenbu_id'] = $id;
        if(count($request->thietbi_name) > 0)
        {
        foreach($request->thietbi_name as $item=>$v){
            $data2=array(
                'phieudenbu_id'=>$id,
                'thietbi_id'=>$request->thietbi_name[$item],
                'phieudenbuDetail_cost' => $request->phieudenbuDetail_cost[$item],
                'phieudenbuDetail_nums' => $request->phieudenbuDetail_nums[$item],
                'phieudenbuDetail_reason' => $request->phieudenbuDetail_reason[$item],
                'phieudenbuDetail_dvt' => $request->dvt[$item],
                'phieudenbuDetail_price' => $request->phieudenbuDetail_cost[$item]*$request->phieudenbuDetail_nums[$item]
            );
        phieudenbu::insert($data2);
      }
        }
    //    phieudenbu::insert($data2);
        return Redirect::to('thongke_phieudenbu');
    }

    public function show_phieudenbudetail($phieudenbu_id)
    {
        $this->AuthLogin();
        $detail_phieudenbu = DB::table('tbl_phieudenbudetail')
            ->join('tbl_phieudenbu', 'tbl_phieudenbudetail.phieudenbu_id', '=', 'tbl_phieudenbu.phieudenbu_id')
            ->orderby('tbl_phieudenbudetail.phieudenbu_id','desc')->get()->where('phieudenbu_id',$phieudenbu_id);
        $manager_phieudenbudetail = view('admin.show_phieudenbudetail')->with('show_phieudenbudetail', $detail_phieudenbu);
        return view('Admin_Layout')->with('admin.show_phieudenbudetail', $manager_phieudenbudetail);
    }
    function get_data($phieudenbu_id)
    {
        $data= DB::table('tbl_phieudenbudetail')
            ->join('tbl_phieudenbu', 'tbl_phieudenbudetail.phieudenbu_id', '=', 'tbl_phieudenbu.phieudenbu_id')
            ->orderby('tbl_phieudenbudetail.phieudenbu_id', 'desc')->get()->where('phieudenbu_id',$phieudenbu_id);
        return $data;
    }
    public function print_phieudenbu($phieudenbu_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_phieudenbudetail($phieudenbu_id));
        $pdf->setPaper('A6','landscape');
        return $pdf->stream();
    }
    public function print_phieudenbudetail($phieudenbu_id)
    {
        $data = $this->get_data($phieudenbu_id);
        $output = '';
        $output .= '<style> body{
                           font-family: DejaVu Sans ;
        }
        .table-styling{
        border: 1px solid black;
        }
        </style>
           <title>Xuất phiếu</title>
        <h1 style=" font-size: large"><center>Công ty TNHH Tín Thành Việt Mỹ</center></h1>
        <h4 style="font-size: 8px; margin-bottom: 0; padding: 0"><right>Địa chỉ: 9/2/18 Khúc Thừa Dụ 2, phường Vĩnh Niệm, quận Lê Chân, Thành phố Hải Phòng.</right></h4>
        <h4 style="font-size: 8px;"><left>Số điện thoại:0383161077</left></h4>
        <h1 style="font-size: medium"><center>PHIẾU HỦY</center></h1>';
        foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                                   <li style=" font-family:DejaVu Sans; font-size:12px; list-style-type:none;"width="75px">Người lập phiếu: '.$detail->phieudenbu_nguoi.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">Mã phiếu: '.$detail->phieudenbu_id.'</li>
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
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Ngày lập: '.$detail->phieudenbu_time.'</th>
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
                                 <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px">Ghi chú</th>
                                 <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px">Thành tiền</th>
                  </tr>
                  </thead>
                        </table>';
        $total = 0;
        foreach($data as $key => $detail) {

        }
        foreach($data as $key => $detail) {
            $subtotal = $detail->phieudenbuDetail_nums*$detail->phieudenbuDetail_cost;
            $total += $subtotal;
            $output .= '
<table class="table styling">
                  <thead>
                 <tr>

                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="90px";>' . $detail->thietbi_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px";>' . $detail->phieudenbuDetail_nums . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($detail->phieudenbuDetail_cost, 0, ',', '.') . 'đ' . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . $detail->phieudenbuDetail_reason . '</th>
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
                <th style="font-size: 10px;" text- align="right" width="250px">Xác nhận</th>
        </tr>
        </thead>';
        $output .= '</table>';
        return $output;
    }
}
