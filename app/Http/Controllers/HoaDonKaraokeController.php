<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Phong;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HoaDonKaraokeController extends Controller
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
    public function thongke_hoadonkaraoke()
    {
        $this->AuthLogin();
        $thongke_hoadonkaraoke = DB::table('tbl_hoadonkaraoke')
            ->join('tbl_phong','tbl_phong.phong_id','=','tbl_hoadonkaraoke.phong_id')
            ->orderby('tbl_hoadonkaraoke.hoadonkaraoke_id', 'desc')->get();
        $manager_hoadonkaraoke = view('admin.thongke_hoadonkaraoke')->with('thongke_hoadonkaraoke', $thongke_hoadonkaraoke);
        return view('Admin_Layout')->with('admin.thongke_hoadonkaraoke', $manager_hoadonkaraoke);
    }
}
