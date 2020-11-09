<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BanCafeController extends Controller
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
    public function add_bancafe()
    {
        $this->AuthLogin();
        $kv_bancafe = DB::table('tbl_khuvuc')->orderby('khuvuc_id','desc')->get();

        return view('admin.add_bancafe')->with('kv_bancafe',$kv_bancafe);
    }
    public function all_bancafe()
    {
        $this->AuthLogin();
        $all_bancafe= DB::table('tbl_bancafe')
            ->join('tbl_khuvuc','tbl_khuvuc.khuvuc_id','=','tbl_bancafe.khuvuc_id')
            ->orderby('tbl_bancafe.bancafe_id','desc')->get();
        $manager_bancafe = view('admin.all_bancafe')->with('all_bancafe',$all_bancafe);
        return view('Admin_Layout')->with('admin.all_bancafe',$manager_bancafe);
    }
    public function save_bancafe(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['bancafe_name'] = $request->bancafe_name;
        $data['khuvuc_id'] = $request->kv_ban;
        $data['bancafe_status'] = $request->bancafe_status;
        DB::table('tbl_bancafe')->insert($data);
        Session::put('message','Thêm bàn thành công');
        return Redirect::to('add_bancafe');
    }
    public function unactive_bancafe($bancafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update(['bancafe_status'=>1]);
        Session::put('message','Đang sử dụng!');
        return Redirect::to('all_bancafe');
    }
    public function active_bancafe($bancafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update(['bancafe_status'=>0]);
        Session::put('message','Bàn rỗng!');
        return Redirect::to('all_bancafe');
    }
    public function edit_bancafe($bancafe_id)
    {
        $this->AuthLogin();
        $kv_bancafe = DB::table('tbl_khuvuc')->orderby('khuvuc_id','desc')->get();

        $edit_bancafe = DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->get();
        $manager_bancafe = view('admin.edit_bancafe')->with('edit_bancafe',$edit_bancafe)->with('kv_bancafe',$kv_bancafe);
        return view('Admin_Layout')->with('admin.edit_bancafe',$manager_bancafe);
    }
    public function update_bancafe(Request $request, $bancafe_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['bancafe_name'] = $request->bancafe_name;
        $data['khuvuc_id'] = $request->kv_bancafe;

        DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->update($data);
        Session::put('message','Cập nhật bàn thành công!');
        return Redirect::to('all_bancafe');
    }
    public function delete_bancafe($bancafe_id)
    {
        $this->AuthLogin();
        DB::table('tbl_bancafe')->where('bancafe_id',$bancafe_id)->delete();
        Session::put('message','Xóa bàn thành công!');
        return Redirect::to('all_bancafe');
    }
}
