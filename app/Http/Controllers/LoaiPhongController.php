<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class LoaiPhongController extends Controller
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
    public function add_loaiphong()
    {
        $this->AuthLogin();
        return view('admin.add_loaiphong');
    }
    public function all_loaiphong()
    {
        $this->AuthLogin();
        $all_loaiphong = DB::table('tbl_loaiphong')->get();
        $manager_loaiphong = view('admin.all_loaiphong')->with('all_loaiphong',$all_loaiphong);
        return view('Admin_Layout')->with('admin.all_loaiphong',$manager_loaiphong);
    }
    public function save_loaiphong(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['loaiphong_name'] = $request->loaiphong_name;
        DB::table('tbl_loaiphong')->insert($data);
        Session::put('message','Thêm loại phòng thành công');
        return Redirect::to('all_loaiphong');
    }
    public function edit_loaiphong($loaiphong_id)
    {
        $this->AuthLogin();
        $edit_loaiphong = DB::table('tbl_loaiphong')->where('loaiphong_id',$loaiphong_id)->get();
        $manager_loaiphong = view('admin.edit_loaiphong')->with('edit_loaiphong',$edit_loaiphong);
        return view('Admin_Layout')->with('admin.edit_loaiphong',$manager_loaiphong);
    }
    public function update_loaiphong(Request $request, $loaiphong_id)
    {
        $this->AuthLogin();
        $data=array();
        $data['loaiphong_name']=$request->loaiphong_name;
        DB::table('tbl_loaiphong')->where('loaiphong_id',$loaiphong_id)->update($data);
        Session::put('message','Cập nhật loại phòng thành công!');
        return Redirect::to('all_loaiphong');
    }
    public function delete_loaiphong($loaiphong_id)
    {
        $this->AuthLogin();
        DB::table('tbl_loaiphong')->where('loaiphong_id',$loaiphong_id)->delete();
        Session::put('message','Xóa loại phòng thành công!');
        return Redirect::to('all_loaiphong');
    }
}
