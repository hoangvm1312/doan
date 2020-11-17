<?php

namespace App\Http\Controllers;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\PhieuXuat;
use Illuminate\Http\Request;
session_start();
class PhieuXuatDetailController extends Controller
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

    public function add_phieuxuat(){
        $this->AuthLogin();
        $name_nguyenlieu = DB::table('tbl_nguyenlieu')->orderby('nguyenlieu_id','desc')->get();
        return view('admin.add_phieuxuat')->with('name_nguyenlieu', $name_nguyenlieu);
    }
    public function save_phieuxuat(Request $request){
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $name = Session::get('admin_name');
        $data['phieuxuat_nguoi'] = $name;
        $data['phieuxuat_time'] = $time;
        
        $id = DB::table('tbl_phieuxuat')->insertGetId($data);
        if(count($request->nguyenlieu_name) > 0)
        {
        foreach($request->nguyenlieu_name as $item=>$v){
            $data2=array(
                'phieuxuat_id'=>$id,
                'nguyenlieu_id'=>$request->nguyenlieu_name[$item],
                'phieuxuatDetail_nums' => $request->phieuxuatDetail_nums[$item],
                'phieuxuatDetail_dvt' => $request->dvt[$item],
            );
        PhieuXuat::insert($data2);
      }
        }
        return Redirect::to('thongke_phieuxuat');
    }


    public function show_phieuxuatdetail($phieuxuat_id)
    {
        $this->AuthLogin();
        $detail_phieuxuat = DB::table('tbl_phieuxuatdetail')
            ->join('tbl_nguyenlieu', 'tbl_phieuxuatdetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieuxuat', 'tbl_phieuxuatdetail.phieuxuat_id', '=', 'tbl_phieuxuat.phieuxuat_id')
            ->orderby('tbl_phieuxuatdetail.phieuxuat_id','desc')->get()->where('phieuxuat_id',$phieuxuat_id);
        $manager_phieuxuatdetail = view('admin.show_phieuxuatdetail')->with('show_phieuxuatdetail', $detail_phieuxuat);
        return view('Admin_Layout')->with('admin.show_phieuxuatdetail', $manager_phieuxuatdetail);
    }
    function get_data($phieuxuat_id)
    {
        $data= DB::table('tbl_phieuxuatdetail')
            ->join('tbl_nguyenlieu', 'tbl_phieuxuatdetail.nguyenlieu_id', '=', 'tbl_nguyenlieu.nguyenlieu_id')
            ->join('tbl_phieuxuat', 'tbl_phieuxuatdetail.phieuxuat_id', '=', 'tbl_phieuxuat.phieuxuat_id')
            ->orderby('tbl_phieuxuatdetail.phieuxuat_id', 'desc')->get()->where('phieuxuat_id',$phieuxuat_id);
        return $data;
    }
    public function print_phieuxuat($phieuxuat_id){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_phieuxuatdetail($phieuxuat_id));
        $pdf->setPaper('A6');
        return $pdf->stream();
    }
    public function print_phieuxuatdetail($phieuxuat_id)
    {
        $data = $this->get_data($phieuxuat_id);
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
        <h1 style="font-size: medium"><center>PHIẾU XUẤT HÀNG</center></h1>';
        foreach($data as $key => $detail)
            $i=1;
        $output.='
        <table class="table styling">
        <thead>
        <tr>
                                   <li style=" font-family:DejaVu Sans; font-size:12px; list-style-type:none;"width="75px">Người xuất: '.$detail->phieuxuat_nguoi.'</li>
                                   <li style=" font-size:9px ;list-style-type:none" width="80px">MHĐ: '.$detail->phieuxuat_id.'</li>
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
                                   <th style=" font-size:10px ;list-style-type:none"; width="75px">Ngày nhập: '.$detail->phieuxuat_time.'</th>
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
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="150px">Sản phẩm</th>
                                <th style="font-size:8px ;border: 1px solid; padding:1px;" width="150px">Số lượng</th>
                  </tr>
                  </thead>
                        </table>';
        $total = 0;
        foreach($data as $key => $detail) {

        }
        foreach($data as $key => $detail) {
            $output .= '
<table class="table styling">
                  <thead>
                 <tr>

                                   <th style="font-size:8px ;border: 1px solid; padding:1px;"width="150px";>' . $detail->nguyenlieu_name . '</th>
                                   <th style="font-size:8px ;border: 1px solid; padding:1px;" width="150px";>' . $detail->phieuxuatDetail_nums . '</th>

                  </tr>
                  </thead>
                        </table>';
        }
        $output.= '
<table>
<tr>
				<td colspan="2">
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
