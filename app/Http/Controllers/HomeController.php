<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','0')->orderby('brand_id','desc')->get();
        $all_product = DB::table('tbl_product')->where('product_status','0')->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product);
    }
    //login
    public function AuthLogin_frontend()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('login')->send();
        }
    }
    public function index_login()
    {
        return view('frontend_login');
    }


    public function dashboard(Request $request)
    {
        $this->AuthLogin_frontend();
        $admin_email = $request->admin_email;
        $admin_password = ($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if (($result)) {
          Session::put('admin_name',$result->admin_name);
          Session::put('admin_id',$result->admin_id);
          return Redirect::to('/');
        }
        else
            Session::put('message','Mật khẩu không chính xác!');
        return Redirect::to('/login');
    }
    public function logout()
    {
        $this->AuthLogin_frontend();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/login');
    }
}
