<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
use App\Http\Requests;
session_start();
class PhongController extends Controller
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
    public function add_phong()
    {
        $this->AuthLogin();
        $loai_phong = DB::table('tbl_loaiphong')->orderby('loaiphong_id','desc')->get();

        return view('admin.add_phong')->with('loai_phong',$loai_phong);
    }
    public function all_phong()
    {
        $this->AuthLogin();
        $all_phong= DB::table('tbl_phong')
            ->join('tbl_loaiphong','tbl_loaiphong.loaiphong_id','=','tbl_phong.loaiphong_id')
            ->orderby('tbl_phong.phong_id','desc')->get();
        $manager_phong = view('admin.all_phong')->with('all_phong',$all_phong);
        return view('Admin_Layout')->with('admin.all_phong',$manager_phong);
    }
    public function save_phong(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['phong_name'] = $request->phong_name;
        $data['loaiphong_id'] = $request->loai_phong;
        $data['phong_status'] = $request->phong_status;
        DB::table('tbl_phong')->insert($data);
        Session::put('message','Thêm phòng thành công');
        return Redirect::to('add_phong');
    }
    public function unactive_phong($phong_id)
    {
        $this->AuthLogin();
        DB::table('tbl_phong')->where('phong_id',$phong_id)->update(['phong_status'=>1]);
        Session::put('message','Đang sử dụng!');
        return Redirect::to('all_phong');
    }
    public function active_phong($phong_id)
    {
        $this->AuthLogin();
        DB::table('tbl_phong')->where('phong_id',$phong_id)->update(['phong_status'=>0]);
        Session::put('message','Phòng rỗng!');
        return Redirect::to('all_phong');
    }
    public function edit_phong($phong_id)
    {
        $this->AuthLogin();
        $loai_phong = DB::table('tbl_loaiphong')->orderby('loaiphong_id','desc')->get();

        $edit_phong = DB::table('tbl_phong')->where('phong_id',$phong_id)->get();
        $manager_phong = view('admin.edit_phong')->with('edit_phong',$edit_phong)->with('loai_phong',$loai_phong);
        return view('Admin_Layout')->with('admin.edit_phong',$manager_phong);
    }
    public function update_phong(Request $request, $phong_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['phong_name'] = $request->phong_name;
        $data['loaiphong_id'] = $request->loai_phong;

        DB::table('tbl_phong')->where('phong_id',$phong_id)->update($data);
        Session::put('message','Cập nhật phòng thành công!');
        return Redirect::to('all_phong');
    }
    public function delete_phong($phong_id)
    {
        $this->AuthLogin();
        DB::table('tbl_phong')->where('phong_id',$phong_id)->delete();
        Session::put('message','Xóa phòng thành công!');
        return Redirect::to('all_phong');
    }
}
