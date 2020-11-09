<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class KhuVucController extends Controller
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
    public function add_khuvuc()
    {
        $this->AuthLogin();
        return view('admin.add_khuvuc');
    }
    public function all_khuvuc()
    {
        $this->AuthLogin();
        $all_khuvuc= DB::table('tbl_khuvuc')->get();
        $quanly_khuvuc = view('admin.all_khuvuc')->with('all_khuvuc',$all_khuvuc);
        return view('Admin_Layout')->with('admin.all_khuvuc',$quanly_khuvuc);
    }
    public function save_khuvuc(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['khuvuc_name'] = $request->khuvuc_name;
        DB::table('tbl_khuvuc')->insert($data);
        Session::put('message','Thêm khu vực sản phẩm thành công');
        return Redirect::to('add_khuvuc');
    }
    public function edit_khuvuc($khuvuc_id)
    {
        $this->AuthLogin();
        $edit_khuvuc = DB::table('tbl_khuvuc')->where('khuvuc_id',$khuvuc_id)->get();
        $quanly_khuvuc = view('admin.edit_khuvuc')->with('edit_khuvuc',$edit_khuvuc);
        return view('Admin_Layout')->with('admin.edit_khuvuc',$quanly_khuvuc);
    }
    public function update_khuvuc(Request $request, $khuvuc_id)
    {
        $this->AuthLogin();
        $data=array();
        $data['khuvuc_name']=$request->khuvuc_name;
        DB::table('tbl_khuvuc')->where('khuvuc_id',$khuvuc_id)->update($data);
        Session::put('message','Cập nhật danh mục sản phẩm thành công!');
        return Redirect::to('all_khuvuc');
    }
    public function delete_khuvuc($khuvuc_id)
    {
        $this->AuthLogin();
        DB::table('tbl_khuvuc')->where('khuvuc_id',$khuvuc_id)->delete();
        Session::put('message','Xóa khu vực thành công!');
        return Redirect::to('all_khuvuc');
    }
}
