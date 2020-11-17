<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use Carbon\Carbon;
use App\Statistic;
use App\Phong;
use App\SanPham;
use App\BanCafe;
use App\NguyenLieu;
use App\KhuVuc;
session_start();
class AdminController extends Controller

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
    public function index()
    {
        return view('Admin_Login');
    }

    public function show_dashboard()
    {
        $this->AuthLogin();
        $phong = Phong::all()->count();
        $khuvuc = KhuVuc::all()->count();
        $sanpham = SanPham::all()->count();
        $ban = BanCafe::all()->count();
        $nguyenlieu = NguyenLieu::all()->count();
        return view('admin.dashboard')->with(compact('phong','khuvuc','sanpham','ban','nguyenlieu'));
    }

    public function dashboard(Request $request)
    {
        $this->AuthLogin();
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if (($result)) {
          Session::put('admin_name',$result->admin_name);
          Session::put('admin_id',$result->admin_id);
          return Redirect::to('/dashboard');
        }
        else
            Session::put('message','Mật khẩu không chính xác!');
        return Redirect::to('/admin');
    }
    public function logout()
    {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistic::whereBetween('time',[$from_date,$to_date])->orderBy('time','ASC')->get();

        foreach($get as $key => $val){
            $chart_data[]=array(
                
                'ngay'=>$val->time,
                'doanhso'=>$val->doanhso,
                'loinhuan'=>$val->loinhuan,
                'tongdon'=>$val->tongdon
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function day_order(Request $request){
        $data=$request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('time',[$dauthangnay,$now])->orderBy('time','ASC')->get();
        foreach($get as $key => $val){
            $chart_data[]=array(
                'ngay'=>$val->time,
                'doanhso'=>$val->doanhso,
                'loinhuan'=>$val->loinhuan,
                'tongdon'=>$val->tongdon 
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request){

        $data=$request->all();

        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();

        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('time',[$sub7ngay,$now])->orderBy('time','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('time',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('time','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay '){
            $get = Statistic::whereBetween('time',[$dauthangnay,$now])->orderBy('time','ASC')->get();
        }else{
            $get = Statistic::whereBetween('time',[$sub365ngay,$now])->orderBy('time','ASC')->get();
        }
        foreach($get as $key => $val){
            $chart_data[]=array(
                'ngay'=>$val->time,
                'doanhso'=>$val->doanhso,
                'loinhuan'=>$val->loinhuan,
                'tongdon'=>$val->tongdon 
            );
        }
        echo $data = json_encode($chart_data);
    }
}
