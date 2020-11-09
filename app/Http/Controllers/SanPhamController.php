<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class SanPhamController extends Controller
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
    public function add_sanpham()
    {
        $this->AuthLogin();
        $kind_sanpham = DB::table('tbl_loaisanpham')->orderby('loaisanpham_id','desc')->get();
        $unit_sanpham = DB::table('tbl_dvt')->orderby('dvt_id','desc')->get();

        return view('admin.add_sanpham')->with('kind_sanpham',$kind_sanpham)->with('unit_sanpham',$unit_sanpham);
    }
    public function all_sanpham()
    {
        $this->AuthLogin();
        $all_sanpham = DB::table('tbl_sanpham')
            ->join('tbl_loaisanpham','tbl_loaisanpham.loaisanpham_id','=','tbl_sanpham.loaisanpham_id')
            ->join('tbl_dvt','tbl_dvt.dvt_id','=','tbl_sanpham.dvt_id')
            ->orderby('tbl_sanpham.sanpham_id','desc')->get();
        $manager_sanpham = view('admin.all_sanpham')->with('all_sanpham',$all_sanpham);
        return view('Admin_Layout')->with('admin.all_sanpham',$manager_sanpham);
    }
    public function save_sanpham(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['sanpham_name'] = $request->sanpham_name;
        $data['sanpham_price'] = $request->sanpham_price;
        $data['loaisanpham_id'] = $request->sanpham_kind;
        $data['dvt_id'] = $request->sanpham_unit;
        $get_image = $request->file('sanpham_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/sanpham',$new_image);
            $data['sanpham_image'] = $new_image;
            DB::table('tbl_sanpham')->insert($data);
            Session::put('message','Thêm sản phẩm thành công');
            return Redirect::to('add_sanpham');
        }
        $data['sanpham_image'] = '';
        DB::table('tbl_sanpham')->insert($data);
        Session::put('message','Thêm sản phẩm thành công');
        return Redirect::to('all_sanpham');
    }
    public function edit_sanpham($sanpham_id)
    {
        $this->AuthLogin();
        $kind_sanpham = DB::table('tbl_loaisanpham')->orderby('loaisanpham_id','desc')->get();
        $unit_sanpham = DB::table('tbl_dvt')->orderby('dvt_id','desc')->get();

        $edit_sanpham = DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->get();
        $manager_sanpham = view('admin.edit_sanpham')->with('edit_sanpham',$edit_sanpham)->with('kind_sanpham',$kind_sanpham)
            ->with('unit_sanpham',$unit_sanpham);
        return view('Admin_Layout')->with('admin.edit_sanpham',$manager_sanpham);
    }
    public function update_sanpham(Request $request, $sanpham_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['sanpham_name'] = $request->sanpham_name;
        $data['sanpham_price'] = $request->sanpham_price;
        $data['loaisanpham_id'] = $request->sanpham_loaisanpham;
        $data['dvt_id'] = $request->sanpham_dvt;
        $get_image = $request->file('sanpham_image');

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/sanpham',$new_image);
            $data['sanpham_image'] = $new_image;
            DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all_sanpham');
        }

        DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('all_sanpham');
    }
    public function delete_sanpham($sanpham_id)
    {
        $this->AuthLogin();
        DB::table('tbl_sanpham')->where('sanpham_id',$sanpham_id)->delete();
        Session::put('message','Xóa sản phẩm thành công!');
        return Redirect::to('all_sanpham');
    }
}
