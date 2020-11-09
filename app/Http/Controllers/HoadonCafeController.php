<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HoadonCafeController extends Controller
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
    public function thongke_hoadoncafe()
    {
        $this->AuthLogin();
        $thongke_hoadoncafe = DB::table('tbl_hoadoncafe')
            ->join('tbl_bancafe','tbl_bancafe.bancafe_id','=','tbl_hoadoncafe.bancafe_id')
            ->orderby('tbl_hoadoncafe.hoadoncafe_id', 'desc')->get();
        $manager_hoadoncafe = view('admin.thongke_hoadoncafe')->with('thongke_hoadoncafe', $thongke_hoadoncafe);
        return view('Admin_Layout')->with('admin.thongke_hoadoncafe', $manager_hoadoncafe);
    }
    public function unactive_hoadoncafe($hoadoncafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->update(['hoadoncafe_status'=>1]);
        Session::put('message','Chưa thanh toán!');
        return Redirect::to('thongke_hoadoncafe');
    }
    public function active_hoadoncafe($hoadoncafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_hoadoncafe')->where('hoadoncafe_id', $hoadoncafe_id)->update(['hoadoncafe_status' => 0]);
        Session::put('message', 'Đã thanh toán!');
        return Redirect::to('thongke_hoadoncafe');
    }
    public function delete_hoadoncafe($hoadoncafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_hoadoncafe')->where('hoadoncafe_id',$hoadoncafe_id)->delete();
        Session::put('message','Xóa thành công!');
        return Redirect::to('all_hoadoncafe');
    }
}
