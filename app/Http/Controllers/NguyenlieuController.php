<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class NguyenlieuController extends Controller
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
    public function add_nguyenlieu()
    {
        $this->AuthLogin();
        return view('admin.add_nguyenlieu');
    }
    public function all_nguyenlieu()
    {
        $this->AuthLogin();
        $all_nguyenlieu= DB::table('tbl_nguyenlieu')->get();
        $quanly_nguyenlieu = view('admin.all_nguyenlieu')->with('all_nguyenlieu',$all_nguyenlieu);
        return view('Admin_Layout')->with('admin.all_nguyenlieu',$quanly_nguyenlieu);
    }
    public function save_nguyenlieu(Request $request)
    {
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $data['nguyenlieu_name'] = $request->nguyenlieu_name;
        $data['nguyenlieu_nums'] = $request->nguyenlieu_nums;
        $data['dvt'] = $request->dvt;
        $data['nguyenlieu_price'] = $request->nguyenlieu_price;
        $data['nguyenlieu_ngaynhap'] = $time;
        $get_image = $request->file('nguyenlieu_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/nguyenlieu',$new_image);
            $data['nguyenlieu_image'] = $new_image;
            DB::table('tbl_nguyenlieu')->insert($data);
            Session::put('message','Thêm nguyên liệu thành công');
            return Redirect::to('add_nguyenlieu');
        }
        $data['nguyenlieu_image'] = '';
        DB::table('tbl_nguyenlieu')->insert($data);
        Session::put('message','Thêm nguyên liệu thành công');
        return Redirect::to('all_nguyenlieu');
    }
    public function edit_nguyenlieu($nguyenlieu_id)
    {
        $this->AuthLogin();
        $edit_nguyenlieu = DB::table('tbl_nguyenlieu')->where('nguyenlieu_id',$nguyenlieu_id)->get();
        $manager_nguyenlieu = view('admin.edit_nguyenlieu')->with('edit_nguyenlieu',$edit_nguyenlieu);
        return view('Admin_Layout')->with('admin.edit_nguyenlieu',$manager_nguyenlieu);
    }
    public function update_nguyenlieu(Request $request, $nguyenlieu_id)
    {
        $this->AuthLogin();
        $data['nguyenlieu_name'] = $request->nguyenlieu_name;
        $data['nguyenlieu_nums'] = $request->nguyenlieu_nums;
        $data['dvt'] = $request->dvt;
        $data['nguyenlieu_price'] = $request->nguyenlieu_price;
        $get_image = $request->file('nguyenlieu_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/nguyenlieu',$new_image);
            $data['nguyenlieu_image'] = $new_image;
            DB::table('tbl_nguyenlieu')->insert($data);
            Session::put('message','Thêm nguyên liệu thành công');
            return Redirect::to('add_nguyenlieu');
        }

        DB::table('tbl_nguyenlieu')->where('nguyenlieu_id',$nguyenlieu_id)->update($data);
        Session::put('message','Cập nhật nguyên liệu thành công!');
        return Redirect::to('all_nguyenlieu');
    }
    public function delete_nguyenlieu($nguyenlieu_id)
    {
        $this->AuthLogin();
        DB::table('tbl_nguyenlieu')->where('nguyenlieu_id',$nguyenlieu_id)->delete();
        Session::put('message','Xóa sản phẩm thành công!');
        return Redirect::to('all_nguyenlieu');
    }
}
