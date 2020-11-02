<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'CafeController@showKhuvuc') ;

//cafe
Route::get('/khu-vuc', 'CafeController@showKhuvuc');
Route::get('/ban-cafe/{khuvuc_id}', 'CafeController@showBancafe');

//menu cafe
Route::get('/menu', 'MenuController@showLoaisp');
Route::get('/menu/{loaisanpham_id}/{ban_id}', 'MenuController@showLoaispTable');
Route::get('/menu-sanpham/{loaisanpham_id}', 'MenuController@showMenu');

//bill product
Route::get('/cafe-select-product/{bancafe_id}/{loaisanpham_id}', 'BillController@showBill');
Route::get('/plus/{sanpham_id}/{hoadoncafe_id}', 'BillController@plusProduct');
Route::get('/minus/{sanpham_id}/{hoadoncafe_id}', 'BillController@minusProduct');
Route::get('/delete/{sanpham_id}/{hoadoncafe_id}', 'BillController@deleteProduct');
Route::get('/choose-product/{sanpham_id}/{ban_id}', 'BillController@chooseProduct');

//print cafe
Route::get('/thanh-toan-cafe/{hoadoncafe_id}', 'OrderController@print_bill_cafe');

//Công nợ
Route::get('/cong-no-cafe/{hoadoncafe_id}', 'CongNoController@saveCongNoCafe');


//karaoke
Route::get('/loai-phong', 'KaraokeController@showLoaiPhong');
Route::get('/phong-karaoke/{loaiphong_id}', 'KaraokeController@showPhongKaraoke');

//menu karaoke
Route::get('/menu-karaoke/{loaisanpham_id}/{ban_id}', 'MenuController@showLoaispTable_Karaoke');

//bill karaoke
Route::get('/karaoke-select-product/{phong_id}/{loaisanpham_id}', 'BillKaraokeController@showBill');
Route::get('/plus-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@plusProduct');
Route::get('/minus-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@minusProduct');
Route::get('/delete-karaoke/{sanpham_id}/{hoadonkaraoke_id}', 'BillKaraokeController@deleteProduct');
Route::get('/choose-product-karaoke/{sanpham_id}/{ban_id}', 'BillKaraokeController@chooseProduct');

//print cafe
Route::get('/check-out-karaoke/{hoadonkaraoke_id}/{phong_id}', 'BillKaraokeController@checkout');
Route::get('/thanh-toan-karaoke/{hoadonkaraoke_id}/{loaiphong_price}', 'OrderController@print_bill_karaoke');

