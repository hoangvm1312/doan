<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class LoaiSanPhamController extends Controller
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
    public function add_loaisanpham()
    {
        $this->AuthLogin();
        return view('admin.add_loaisanpham');
    }
    public function all_loaisanpham()
    {
        $this->AuthLogin();
        $all_loaisanpham = DB::table('tbl_loaisanpham')->get();
        $manager_loaisanpham = view('admin.all_loaisanpham')->with('all_loaisanpham',$all_loaisanpham);
        return view('Admin_Layout')->with('admin.all_loaisanpham',$manager_loaisanpham);
    }
    public function save_loaisanpham(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['loaisanpham_name'] = $request->loaisanpham_name;
        DB::table('tbl_loaisanpham')->insert($data);
        Session::put('message','Thêm loại sản phẩm thành công');
        return Redirect::to('all_loaisanpham');
    }
    public function edit_loaisanpham($loaisanpham_id)
    {
        $this->AuthLogin();
        $edit_loaisanpham = DB::table('tbl_loaisanpham')->where('loaisanpham_id',$loaisanpham_id)->get();
        $manager_loaisanpham = view('admin.edit_loaisanpham')->with('edit_loaisanpham',$edit_loaisanpham);
        return view('Admin_Layout')->with('admin.edit_loaisanpham',$manager_loaisanpham);
    }
    public function update_loaisanpham(Request $request, $loaisanpham_id)
    {
        $this->AuthLogin();
        $data=array();
        $data['loaisanpham_name']=$request->loaisanpham_name;
        DB::table('tbl_loaisanpham')->where('loaisanpham_id',$loaisanpham_id)->update($data);
        Session::put('message','Cập nhật loại sản phẩm thành công!');
        return Redirect::to('all_loaisanpham');
    }
    public function delete_loaisanpham($loaisanpham_id)
    {
        $this->AuthLogin();
        DB::table('tbl_loaisanpham')->where('loaisanpham_id',$loaisanpham_id)->delete();
        Session::put('message','Xóa loại sản phẩm thành công!');
        return Redirect::to('all_loaisanpham');
    }
}
