<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class DVTController extends Controller
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
    public function add_dvt()
    {
        $this->AuthLogin();
        return view('admin.add_dvt');
    }
    public function all_dvt()
    {
        $this->AuthLogin();
        $all_dvt = DB::table('tbl_dvt')->get();
        $manager_dvt = view('admin.all_dvt')->with('all_dvt',$all_dvt);
        return view('Admin_Layout')->with('admin.all_dvt',$manager_dvt);
    }
    public function save_dvt(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['dvt_name'] = $request->dvt_name;
        DB::table('tbl_dvt')->insert($data);
        Session::put('message','Thêm đơn vị tính thành công');
        return Redirect::to('all_dvt');
    }
    public function edit_dvt($dvt_id)
    {
        $this->AuthLogin();
        $edit_dvt = DB::table('tbl_dvt')->where('dvt_id',$dvt_id)->get();
        $manager_dvt = view('admin.edit_dvt')->with('edit_dvt',$edit_dvt);
        return view('Admin_Layout')->with('admin.edit_dvt',$manager_dvt);
    }
    public function update_dvt(Request $request, $dvt_id)
    {
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName(); //lấy tên ảnh
            $name_image = current(explode('.',$get_name_image));//phân tách tên ảnh
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();//lấy tên + random + đuôi ảnh
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công');
            return Redirect::to('all_product');
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm thành công!');
        return Redirect::to('all_product');
    }
    public function delete_dvt($dvt_id)
    {
        $this->AuthLogin();
        DB::table('tbl_dvt')->where('dvt_id',$dvt_id)->delete();
        Session::put('message','Xóa đơn vị tính thành công!');
        return Redirect::to('all_dvt');
    }
}
