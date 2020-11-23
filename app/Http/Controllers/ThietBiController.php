<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class ThietBiController extends Controller
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
    public function add_thietbi()
    {
        $this->AuthLogin();
        return view('admin.add_thietbi');
    }
    public function all_thietbi()
    {
        $this->AuthLogin();
        $all_thietbi= DB::table('tbl_thietbi')->get();
        $quanly_thietbi = view('admin.all_thietbi')->with('all_thietbi',$all_thietbi);
        return view('Admin_Layout')->with('admin.all_thietbi',$quanly_thietbi);
    }
    public function save_thietbi(Request $request)
    {
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data = array();
        $data['thietbi_name'] = $request->thietbi_name;
        $data['thietbi_price'] = $request->thietbi_price;
       
        $get_image = $request->file('thietbi_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/nguyenlieu',$new_image);
            $data['thietbi_image'] = $new_image;
            DB::table('tbl_thietbi')->insert($data);
            Session::put('message','Thêm nguyên liệu thành công');
            return Redirect::to('add_thietbi');
        }
        $data['thietbi_image'] = '';
        DB::table('tbl_thietbi')->insert($data);
        Session::put('message','Thêm nguyên liệu thành công');
        return Redirect::to('all_thietbi');
    }
    public function edit_thietbi($thietbi_id)
    {
        $this->AuthLogin();
        $edit_thietbi = DB::table('tbl_thietbi')->where('thietbi_id',$thietbi_id)->get();
        $manager_thietbi = view('admin.edit_thietbi')->with('edit_thietbi',$edit_thietbi);
        return view('Admin_Layout')->with('admin.edit_thietbi',$manager_thietbi);
    }
    public function update_thietbi(Request $request, $thietbi_id)
    {
        $this->AuthLogin();
        $time=Carbon::now('Asia/Ho_Chi_Minh');
        $data['thietbi_name'] = $request->thietbi_name;
        $data['thietbi_price'] = $request->thietbi_price;
       
        $get_image = $request->file('thietbi_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/nguyenlieu',$new_image);
            $data['thietbi_image'] = $new_image;
            DB::table('tbl_thietbi')->insert($data);
            Session::put('message','Thêm nguyên liệu thành công');
            return Redirect::to('add_thietbi');
        }

        DB::table('tbl_thietbi')->where('thietbi_id',$thietbi_id)->update($data);
        Session::put('message','Cập nhật thiết bị thành công!');
        return Redirect::to('all_thietbi');
    }
    public function delete_thietbi($thietbi_id)
    {
        $this->AuthLogin();
        DB::table('tbl_thietbi')->where('thietbi_id',$thietbi_id)->delete();
        Session::put('message','Xóa thiết bị thành công!');
        return Redirect::to('all_thietbi');
    }
}
