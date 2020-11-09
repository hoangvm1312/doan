<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class PhieuNhapController extends Controller
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
    public function thongke_phieunhap()
    {
        $this->AuthLogin();
        $thongke_phieunhap = DB::table('tbl_phieunhap')
            ->orderby('tbl_phieunhap.phieunhap_id', 'desc')->get();
        $manager_phieunhap = view('admin.thongke_phieunhap')->with('thongke_phieunhap', $thongke_phieunhap);
        return view('Admin_Layout')->with('admin.thongke_phieunhap', $manager_phieunhap);
    }
}
