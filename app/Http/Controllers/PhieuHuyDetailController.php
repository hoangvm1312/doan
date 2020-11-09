<?php

namespace App\Http\Controllers;

use DB;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\PhieuHuy;
session_start();

class PhieuHuyDetailController extends Controller
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
    public function add_phieuhuy(){
        $this->AuthLogin();
        $name_nguyenlieu = DB::table('tbl_nguyenlieu')->orderby('nguyenlieu_id','desc')->get();
        return view('admin.add_phieuhuy')->with('name_nguyenlieu', $name_nguyenlieu);
    }
    public function save_phieuhuy(Request $request){
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $name = Session::get('admin_name');
        $data['phieuhuy_nguoi'] = $name;
        $data['phieuhuy_time'] = $time;

        // $datadetail = array();
        // $datadetail['nguyenlieu_id'] = $request->nguyenlieu_name;
        // $datadetail['phieuhuy_id'] = $id;
        // $datadetail['phieuhuyDetail_cost'] = $request->phieuhuyDetail_cost;
        // $datadetail['phieuhuyDetail_nums'] = $request->phieuhuyDetail_nums;
        // $datadetail['phieuhuyDetail_dvt'] = $request->dvt;
        $price = 0;
        if(count($request->nguyenlieu_name) > 0)
        {
        foreach($request->nguyenlieu_name as $item=>$v){
            $price+= $request->phieuhuyDetail_cost[$item]*$request->phieuhuyDetail_nums[$item];
                                                        }
        }
        // $price+= $request->phieuhuyDetail_cost*$request->phieuhuyDetail_nums;
        // // $total = DB::table('phieuhuydetail')->sum('phieuhuyDetail_price');
        // $datadetail['phieuhuyDetail_reason'] = $request->phieuhuyDetail_reason;
        // $datadetail['phieuhuyDetail_price'] = $price;
        $data['phieuhuy_price'] =$price;
        $id = DB::table('tbl_phieuhuy')->insertGetId($data);
        // $lastInsertedID = $data->insert_id;
        // echo $lastInsertedID;
        // echo $id;
        // $datadetail['phieuhuy_id'] = $id;
        if(count($request->nguyenlieu_name) > 0)
        {
        foreach($request->nguyenlieu_name as $item=>$v){
            $data2=array(
                'phieuhuy_id'=>$id,
                'nguyenlieu_id'=>$request->nguyenlieu_name[$item],
                'phieuhuyDetail_cost' => $request->phieuhuyDetail_cost[$item],
                'phieuhuyDetail_nums' => $request->phieuhuyDetail_nums[$item],
                'phieuhuyDetail_reason' => $request->phieuhuyDetail_reason[$item],
                'phieuhuyDetail_dvt' => $request->dvt[$item],
                'phieuhuyDetail_price' => $request->phieuhuyDetail_cost[$item]*$request->phieuhuyDetail_nums[$item]
            );
        PhieuHuy::insert($data2);
      }
        }
    //    PhieuHuy::insert($data2);
        return Redirect::to('thongke_phieuhuy');
    }

    public function show_phieuhuydetail($phieuhuy_id)
    {
        $this->AuthLogin();
        $detail_phieuhuy = DB::table('tbl_phieuhuydetail')
            ->join('tbl_nguyenlieu', 'tbl_phieuhuydetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieuhuy', 'tbl_phieuhuydetail.phieuhuy_id', '=', 'tbl_phieuhuy.phieuhuy_id')
            ->orderby('tbl_phieuhuydetail.phieuhuy_id','desc')->get()->where('phieuhuy_id',$phieuhuy_id);
        $manager_phieuhuydetail = view('admin.show_phieuhuydetail')->with('show_phieuhuydetail', $detail_phieuhuy);
        return view('Admin_Layout')->with('admin.show_phieuhuydetail', $manager_phieuhuydetail);
    }
    function get_data($phieuhuy_id)
    {
        $data= DB::table('tbl_phieuhuydetail')
            ->join('tbl_nguyenlieu', 'tbl_phieuhuydetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieuhuy', 'tbl_phieuhuydetail.phieuhuy_id', '=', 'tbl_phieuhuy.phieuhuy_id')
            ->orderby('tbl_phieuhuydetail.phieuhuy_id', 'desc')->get()->where('phieuhuy_id',$phieuhuy_id);
        return $data;
    }
    public function print_phieuhuy($phieuhuy_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_phieuhuydetail($phieuhuy_id));
        $pdf->setPaper('A6','landscape');
        return $pdf->stream();
    }
    public function print_phieuhuydetail($phieuhuy_id)
    {
        $data = $this->get_data($phieuhuy_id);
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
                                   <li style=" font-family:DejaVu Sans; font-size:12px; list-style-type:none;"width="75px">Người lập phiếu: '.$detail->phieuhuy_nguoi.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">Mã phiếu: '.$detail->phieuhuy_id.'</li>
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
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Ngày lập: '.$detail->phieuhuy_time.'</th>
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
            $subtotal = $detail->phieuhuyDetail_nums*$detail->phieuhuyDetail_cost;
            $total += $subtotal;
            $output .= '
<table class="table styling">
                  <thead>
                 <tr>

                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="90px";>' . $detail->nguyenlieu_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="50px";>' . $detail->phieuhuyDetail_nums . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . number_format($detail->phieuhuyDetail_cost, 0, ',', '.') . 'đ' . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="90px";>' . $detail->phieuhuyDetail_reason . '</th>
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
