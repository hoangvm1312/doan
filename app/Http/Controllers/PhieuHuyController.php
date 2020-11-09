<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class PhieuHuyController extends Controller
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
    public function thongke_phieuhuy()
    {
        $this->AuthLogin();
        $thongke_phieuhuy = DB::table('tbl_phieuhuy')
            ->orderby('tbl_phieuhuy.phieuhuy_id', 'desc')->get();
        $manager_phieuhuy = view('admin.thongke_phieuhuy')->with('thongke_phieuhuy', $thongke_phieuhuy);
        return view('Admin_Layout')->with('admin.thongke_phieuhuy', $manager_phieuhuy);
    }
    
}
