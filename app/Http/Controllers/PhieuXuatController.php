<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\PhieuXuat;
session_start();
class PhieuXuatController extends Controller
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
    public function thongke_phieuxuat()
    {
        $this->AuthLogin();
        $thongke_phieuxuat = DB::table('tbl_phieuxuat')
            ->orderby('tbl_phieuxuat.phieuxuat_id', 'desc')->get();
        $manager_phieuxuat = view('admin.thongke_phieuxuat')->with('thongke_phieuxuat', $thongke_phieuxuat);
        return view('Admin_Layout')->with('admin.thongke_phieuxuat', $manager_phieuxuat);
    }
    

}
