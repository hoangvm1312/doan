<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class PhieuThueController extends Controller
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
    public function thongke_phieuthue()
    {
        $this->AuthLogin();
        $thongke_phieuthue = DB::table('tbl_phieuthue')
            ->join('tbl_phong','tbl_phong.phong_id','=','tbl_phieuthue.phong_id')
            ->orderby('tbl_phieuthue.phieuthue_id', 'desc')->get();
        $manager_phieuthue = view('admin.thongke_phieuthue')->with('thongke_phieuthue', $thongke_phieuthue);
        return view('Admin_Layout')->with('admin.thongke_phieuthue', $manager_phieuthue);
    }
}
